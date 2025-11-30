<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function dailyProductReport(Request $request)
    {
        $today = Carbon::today();

        $orders = Order::whereDate('created_at', $today)
            ->orderBy('id', 'desc')
            ->paginate(20);

        $totalOrders = Order::whereDate('created_at', $today)->count();
        $totalRevenue = Order::whereDate('created_at', $today)->sum('totalPrice');

        return view('backend.reports.index', compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'today'
        ));
    }

    public function categorySalesReport(Request $request)
    {
        // optional date filters
        $ordersQuery = Order::query()->where('status', '!=', 'cancelled');
        if ($request->filled('from')) {
            $ordersQuery->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $ordersQuery->whereDate('created_at', '<=', $request->to);
        }

        $orders = $ordersQuery->get(['id', 'items', 'totalPrice']);

        // load product -> category map and categories names
        $productCategory = Product::pluck('category_id', 'id')->toArray(); // [productId => categoryId]
        $categories = Category::pluck('name', 'id')->toArray();          // [categoryId => name]

        $report = []; // [categoryId => ['quantity' => X, 'revenue' => Y]]

        foreach ($orders as $order) {
            $items = ($order->items);
            if (! is_array($items)) {
                continue;
            }

            foreach ($items as $it) {
                $prodId = isset($it['id']) ? (int) $it['id'] : null;
                $qty = isset($it['quantity']) ? (int) $it['quantity'] : (isset($it['qty']) ? (int) $it['qty'] : 0);
                $price = isset($it['price']) ? (float) $it['price'] : 0.0;

                if (! $prodId) {
                    continue;
                }

                $catId = $productCategory[$prodId] ?? null;
                if (! $catId) {
                    $catId = 0;
                } // uncategorized bucket if you like

                if (! isset($report[$catId])) {
                    $report[$catId] = ['quantity' => 0, 'revenue' => 0.0];
                }

                $report[$catId]['quantity'] += $qty;
                $report[$catId]['revenue'] += ($qty * $price);
            }
        }

        // transform to list for the view
        $rows = [];
        foreach ($report as $catId => $data) {
            $rows[] = (object) [
                'category_id' => $catId,
                'category_name' => $categories[$catId] ?? 'Uncategorized',
                'total_quantity_sold' => $data['quantity'],
                'total_revenue' => $data['revenue'],
            ];
        }

        // sort by quantity desc
        usort($rows, fn ($a, $b) => $b->total_quantity_sold <=> $a->total_quantity_sold);

        return view('backend.reports.category-sales', ['report' => $rows]);
    }
}
