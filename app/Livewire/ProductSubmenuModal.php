<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use Livewire\Component;

class ProductSubmenuModal extends Component
{
    public $show = false;

    public $product;

    public $selectedExtras = [];

    public $additionalCost = 0;

    protected $listeners = ['openSubMenu'];

    // Called when parent triggers modal
    public function openSubMenu($product)
    {
        $this->product = $product;
        $this->selectedExtras = [];
        $this->additionalCost = 0;
        $this->show = true;
    }

    public function toggleExtra($name, $price)
    {
        if (isset($this->selectedExtras[$name])) {
            unset($this->selectedExtras[$name]);
        } else {
            $this->selectedExtras[$name] = $price;
        }
        $this->additionalCost = array_sum($this->selectedExtras);
    }

    public function addToCart()
    {
        $finalItem = [
            'id' => $this->product['id'],
            'name' => $this->product['name'],
            'pricePickup' => $this->product['price_pickup'],
            'priceDelivery' => $this->product['price_delivery'],
            'image' => $this->product['image'],
            'extras' => [],
        ];

        foreach ($this->selectedExtras as $name => $price) {
            $finalItem['extras'][] = [
                'name' => $name,
                'price' => $price,
            ];
        }
        CartHelper::addToCart($finalItem);

        // Notify parent/cart to refresh
        $this->dispatch('cartUpdated');

        $this->show = false;
    }

    public function close()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.product-submenu-modal');
    }
}
