<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use App\Models\City;
use App\Models\PostalCode;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DeliverySelector extends Component
{
    public $isOpen = false;

    public $cities = [];

    public $postalCodes = [];

    public $city;

    public $postalCode = '';

    protected $listeners = [
        'openDeliveryModal' => 'open',
    ];

    public function mount()
    {
        // Load cities on mount
        $this->cities = City::orderBy('name')->get();

        // Open modal automatically if delivery mode not set
        if (! Session::get('delivery.mode')) {
            $this->isOpen = true;
        }
    }

    public function open()
    {
        $this->isOpen = true;
    }

    // When city changes, load postal codes
    public function updatedCity($value)
    {
        if ($value) {
            $this->postalCodes = PostalCode::where('city_id', $value)
                ->orderBy('code')
                ->get();
        } else {
            $this->postalCodes = [];
        }
        $this->postalCode = '';
    }

    // Save delivery mode
    public function saveDelivery()
    {
        if (! $this->city || ! $this->postalCode) {
            return;
        }

        $city = City::find($this->city);

        Session::put('delivery.mode', 'delivery');
        Session::put('cart_delivery_type', 'delivery');
        CartHelper::updatePricesByDeliveryType('delivery');

        Session::put('delivery.address', "{$city->name}, {$this->postalCode}");

        $this->isOpen = false;

        // Notify header to refresh display
        $this->dispatch('deliverySelected');

        // Notify cart to recalculate totals
        $this->dispatch('cartUpdated');
    }

    public function savePickup()
    {
        Session::put('delivery.mode', 'pickup');
        Session::put('cart_delivery_type', 'pickup');
        CartHelper::updatePricesByDeliveryType('pickup');
        Session::forget('delivery.address');

        $this->isOpen = false;

        // Notify header to refresh display
        $this->dispatch('deliverySelected');

        // Notify cart to recalculate totals
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.delivery-selector');
    }
}
