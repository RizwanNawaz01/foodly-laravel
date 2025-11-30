<?php

namespace App\Http\Controllers;

use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout'); // Just renders the blade
    }

    public function orderConfirmed($code)
    {
        $order = Order::where('orderCode', $code)->first();

        return view('frontend.order_confirmed', compact('order'));
    }

    public function orderTrack($code)
    {
        $order = Order::where('orderCode', $code)->first();

        return view('frontend.order_track', compact('order'));
    }
}
