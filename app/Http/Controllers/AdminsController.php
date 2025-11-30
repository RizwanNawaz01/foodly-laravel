<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminsController extends Controller
{
    public function index()
    {

        $stats = [
            [
                'title' => 'Total Orders',
                'value' => Order::count(),
                'icon' => 'ph-shopping-cart-simple',
                'color' => 'bg-blue-500',
            ],
            [
                'title' => 'Success Orders',
                'value' => Order::where('status', 'completed')->count(),
                'icon' => 'ph-check-circle',
                'color' => 'bg-green-500',
            ],
            [
                'title' => 'Pending Orders',
                'value' => Order::where('status', 'pending')->count(),
                'icon' => 'ph-clock',
                'color' => 'bg-primary',
            ],
            [
                'title' => 'Cancelled Orders',
                'value' => Order::where('status', 'cancelled')->count(),
                'icon' => 'ph-x-circle',
                'color' => 'bg-red-500',
            ],
            [
                'title' => 'Total Products',
                'value' => Product::count(),
                'icon' => 'ph-cube',
                'color' => 'bg-black',
            ],
            [
                'title' => 'Total Earnings',
                'value' => format_currency(Order::where('status', 'completed')->sum('totalPrice')),
                'icon' => 'ph-currency-dollar',
                'color' => 'bg-primary',
            ],
            [
                'title' => 'Total Categories',
                'value' => Category::count(),
                'icon' => 'ph-squares-four',
                'color' => 'bg-red-500',
            ],
            [
                'title' => 'Total Users',
                'value' => User::count(),
                'icon' => 'ep-user-filled',
                'color' => 'bg-orange-500',
            ],
        ];

        // Last 7 days earnings
        $chart = Order::where('status', 'completed')
            ->selectRaw('DATE(created_at) as date, SUM(totalPrice) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->take(7)
            ->get();

        return view('backend.dashboard', compact('stats', 'chart'));
    }
}
