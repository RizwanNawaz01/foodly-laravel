<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use App\Models\Product;
use Livewire\Component;

class SearchModal extends Component
{
    public $isOpen = false;

    public $searchQuery = '';

    public $searchResults = [];

    public $isSearching = false;

    protected $listeners = ['openSearchModal' => 'open'];

    public function open()
    {
        $this->isOpen = true;
        $this->searchQuery = '';
        $this->searchResults = [];
    }

    public function close()
    {
        $this->isOpen = false;
        $this->searchQuery = '';
        $this->searchResults = [];
    }

    public function updatedSearchQuery()
    {
        $this->search();
    }

    public function search()
    {
        if (strlen($this->searchQuery) < 2) {
            $this->searchResults = [];

            return;
        }

        $this->isSearching = true;

        $this->searchResults = Product::where(function ($query) {
            $query->where('name', 'like', '%'.$this->searchQuery.'%')
                ->orWhere('description', 'like', '%'.$this->searchQuery.'%');
        })
            ->with(['category'])
            ->take(10)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price_delivery,
                    'price_pickup' => $product->price_pickup,
                    'image' => $product->image,
                    'category' => $product->category?->name,
                    'in_stock' => $product->qty > 0,
                ];
            });

        $this->isSearching = false;
    }

    public function clearSearch()
    {
        $this->searchQuery = '';
        $this->searchResults = [];
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (! $product) {
            session()->flash('error', 'Product not found');

            return;
        }

        if ($product->subMenu && count($product->subMenu) > 0) {
            $this->dispatch('openSubMenu', $product->toArray());

            return;
        }

        CartHelper::addToCart([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price_delivery, // Use single price field
            'pricePickup' => $product->price_pickup ?? $product->price_delivery,
            'priceDelivery' => $product->price_delivery ?? $product->price_delivery,
            'quantity' => 1,
            'extras' => [],
            'image' => $product->image ?? '',
            'note' => '',
        ]);

        // Dispatch event to update cart count in header
        $this->dispatch('cartUpdated');

        // Optional: Open cart automatically
        $this->dispatch('openCart');

        // Show success message (optional)
        session()->flash('success', $product->name.' added to cart!');
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}
