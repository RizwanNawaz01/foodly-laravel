<?php

namespace App\Livewire;

use App\Http\Helpers\CartHelper;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Menu extends Component
{
    protected $listeners = ['cartUpdated'];

    public function render()
    {
        $products = Product::where('qty', '>', 0)->get();
        $categories = Category::all();

        return view('livewire.menu', compact('products', 'categories'));
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
}
