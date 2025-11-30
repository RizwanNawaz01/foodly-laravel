<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{
    public $isOpen = false;

    public $items = [];

    public $deliveryType = 'delivery';

    public $currency = 'CHF';

    protected $listeners = [
        'openCart' => 'open',
        'closeCart' => 'close',
        'cartUpdated' => 'loadCart',
        'deliverySelected' => 'syncDeliveryType',
    ];

    public function mount()
    {
        $this->loadCart();
        $this->deliveryType = Session::get('cart_delivery_type', 'delivery');
        $this->currency = currency();
    }

    public function loadCart()
    {
        $this->items = Session::get('cart_items', []);
    }

    public function open()
    {
        $this->isOpen = true;
        $this->loadCart();
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function setDeliveryType($type)
    {
        $this->deliveryType = $type;
        Session::put('cart_delivery_type', $type);
        CartHelper::updatePricesByDeliveryType($type);
        $this->loadCart();
        $this->dispatch('deliveryTypeChanged', type: $type);
    }

    public function syncDeliveryType()
    {
        // Sync delivery type from session (updated by DeliverySelector)
        $this->deliveryType = Session::get('cart_delivery_type', 'delivery');
        $this->loadCart();
    }

    public function getTotalPrice()
    {
        $total = 0;

        foreach ($this->items as $item) {
            // Get base price
            $basePrice = $item['price'] ?? 0;

            // Add extras price
            $extrasPrice = 0;
            if (! empty($item['extras'])) {
                foreach ($item['extras'] as $extra) {
                    $extrasPrice += $extra['price'] ?? 0;
                }
            }

            // Calculate item total
            $itemTotal = ($basePrice + $extrasPrice) * $item['quantity'];
            $total += $itemTotal;
        }

        // Add 5% tax
        $taxRate = 0.05;
        $totalWithTax = $total * (1 + $taxRate);

        return number_format($totalWithTax, 2, '.', '');
    }

    public function getItemTotal($item)
    {
        // Base price
        $basePrice = $item['price'] ?? 0;

        // Add extras
        $extrasPrice = 0;
        if (! empty($item['extras'])) {
            foreach ($item['extras'] as $extra) {
                $extrasPrice += $extra['price'] ?? 0;
            }
        }

        // Total with quantity
        $total = ($basePrice + $extrasPrice) * $item['quantity'];

        // Add 5% tax
        $taxRate = 0.05;
        $totalWithTax = $total * (1 + $taxRate);

        return number_format($totalWithTax, 2, '.', '');
    }

    public function increase($itemId)
    {
        $items = Session::get('cart_items', []);

        if (isset($items[$itemId])) {
            $items[$itemId]['quantity']++;
            Session::put('cart_items', $items);
            $this->loadCart();
            $this->dispatch('cartUpdated'); // Notify header to update count
        }
    }

    public function decrease($itemId)
    {
        $items = Session::get('cart_items', []);

        if (isset($items[$itemId])) {
            if ($items[$itemId]['quantity'] > 1) {
                $items[$itemId]['quantity']--;
            } else {
                unset($items[$itemId]);
            }
            Session::put('cart_items', $items);
            $this->loadCart();
            $this->dispatch('cartUpdated'); // Notify header to update count
        }
    }

    public function remove($itemId)
    {
        $items = Session::get('cart_items', []);
        unset($items[$itemId]);
        Session::put('cart_items', $items);
        $this->loadCart();
        $this->dispatch('cartUpdated'); // Notify header to update count
    }

    public function updateNote($itemId, $note)
    {
        $items = Session::get('cart_items', []);
        if (isset($items[$itemId])) {
            $items[$itemId]['note'] = $note;
            Session::put('cart_items', $items);
            $this->loadCart();
        }
    }

    public function clearNote($itemId)
    {
        $this->updateNote($itemId, '');
    }

    public function clearCart()
    {
        Session::forget('cart_items');
        $this->items = [];
        $this->dispatch('cartUpdated'); // Notify header to update count
    }

    public function getTotalItems()
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function render()
    {
        return view('livewire.cart', [
            'totalPrice' => $this->getTotalPrice(),
            'totalItems' => $this->getTotalItems(),
        ]);
    }
}
