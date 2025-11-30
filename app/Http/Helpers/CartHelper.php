<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Session;

class CartHelper
{
    /**
     * Add item to cart
     */
    public static function addToCart(array $item)
    {
        $cart = Session::get('cart_items', []);

        // Generate unique ID if not provided
        $itemId = $item['id'] ?? uniqid('item_');

        $deliveryType = Session::get('cart_delivery_type', 'delivery');

        if ($deliveryType === 'delivery') {
            $item['price'] = $item['priceDelivery'];
        } else {
            $item['price'] = $item['pricePickup'];
        }

        if (isset($cart[$itemId])) {
            // Item exists, increase quantity
            $cart[$itemId]['quantity'] += ($item['quantity'] ?? 1);
        } else {
            // New item
            $cart[$itemId] = array_merge([
                'id' => $itemId,
                'name' => '',
                'price' => $item['price'],
                'quantity' => 1,
                'pricePickup' => 0,
                'priceDelivery' => 0,
                'note' => '',
                'extras' => [],
            ], $item);
        }

        Session::put('cart_items', $cart);

        return $cart;
    }

    /**
     * Remove item from cart
     */
    public static function removeFromCart(string $itemId)
    {
        $cart = Session::get('cart_items', []);
        unset($cart[$itemId]);
        Session::put('cart_items', $cart);

        return $cart;
    }

    /**
     * Update item quantity
     */
    public static function updateQuantity(string $itemId, int $quantity)
    {
        $cart = Session::get('cart_items', []);

        if (isset($cart[$itemId])) {
            if ($quantity <= 0) {
                unset($cart[$itemId]);
            } else {
                $cart[$itemId]['quantity'] = $quantity;
            }
            Session::put('cart_items', $cart);
        }

        return $cart;
    }

    /**
     * Clear entire cart
     */
    public static function clearCart()
    {
        Session::forget('cart_items');
        Session::forget('cart_delivery_type');
    }

    /**
     * Get cart items
     */
    public static function getCart()
    {
        return Session::get('cart_items', []);
    }

    /**
     * Get cart count
     */
    public static function getCartCount()
    {
        $items = self::getCart();

        return array_sum(array_column($items, 'quantity'));
    }

    /**
     * Get cart total
     */
    public static function getCartTotal(string $deliveryType = 'delivery')
    {
        $items = self::getCart();
        $total = 0;

        foreach ($items as $item) {
            $price = $deliveryType === 'delivery'
                ? ($item['priceDelivery'] ?? 0)
                : ($item['pricePickup'] ?? 0);

            $effectivePrice = $deliveryType === 'delivery'
                ? ($item['totalPriceDelivery'] ?? $price)
                : ($item['totalPrice'] ?? $price);

            $total += $effectivePrice * $item['quantity'];
        }

        return $total;
    }

    public static function updatePricesByDeliveryType(string $deliveryType)
    {
        $cart = Session::get('cart_items', []);

        foreach ($cart as $id => $item) {

            $newPrice = $deliveryType === 'pickup'
                ? ($item['pricePickup'] ?? 0)
                : ($item['priceDelivery'] ?? 0);

            $cart[$id]['price'] = $newPrice;
        }

        Session::put('cart_items', $cart);

        return $cart;
    }

    /**
     * Validate cart before checkout
     */
    public static function validateCart()
    {
        $cart = self::getCart();

        if (empty($cart)) {
            return [
                'valid' => false,
                'message' => 'Cart is empty',
            ];
        }

        foreach ($cart as $item) {
            if ($item['quantity'] <= 0) {
                return [
                    'valid' => false,
                    'message' => 'Invalid quantity for '.$item['name'],
                ];
            }
        }

        return [
            'valid' => true,
            'message' => 'Cart is valid',
        ];
    }
}
