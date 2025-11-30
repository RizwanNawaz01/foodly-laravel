<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostalCodesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\SubmenusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontPageController::class, 'index'])->name('front.home');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('front.checkout');
Route::get('/order_confirmed/{code}', [CheckoutController::class, 'orderConfirmed'])->name('front.order_confirmed');
Route::get('/orders_track/{code}', [CheckoutController::class, 'orderTrack'])->name('front.orders_track');
Route::get('/category/{slug}', [FrontPageController::class, 'category'])->name('front.category');
// Original dashboard route - now with role redirect middleware
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'redirect.role'])
    ->name('dashboard');

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminsController::class, 'index'])->name('dashboard');
    Route::resource('customer', CustomersController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('submenus', SubmenusController::class);
    Route::resource('cities', CitiesController::class);
    Route::resource('postal_codes', PostalCodesController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('sliders', SlidersController::class);
    Route::resource('pages', PagesController::class);
    Route::resource('about', AboutController::class);
    Route::resource('orders', OrdersController::class);
    Route::get('orders/{order}/print', [OrdersController::class, 'print'])->name('orders.print');
    Route::Patch('orders/{order}/updateStatus', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::Patch('customer/{customer}/updateCustomer', [CustomersController::class, 'updateCustomer'])->name('customer.updateCustomer');
    Route::Patch('customer/{customer}/updateAddress', [CustomersController::class, 'updateAddress'])->name('customer.updateAddress');

    Route::get('reports/daily-order-report', [ReportsController::class, 'dailyProductReport'])->name('reports.daily-order-report');
    Route::get('reports/category-sales-report', [ReportsController::class, 'categorySalesReport'])->name('reports.category-sales-report');

});

// Customer routes
Route::middleware(['auth', 'verified', 'customer'])->prefix('frontend')->name('customer.')->group(function () {
    Route::get('dashboard', [CustomersController::class, 'dashboard'])->name('dashboard');
    Route::get('orders', [CustomersController::class, 'orders'])->name('orders');
    Route::get('profile', [CustomersController::class, 'profile'])->name('profile');
    Route::get('address', [CustomersController::class, 'address'])->name('address');
    Route::post('address', [CustomersController::class, 'saveAddress'])->name('address.save');
    Route::get('/postal-codes/{city}', [CustomersController::class, 'getPostalCodes']);

});

require __DIR__.'/auth.php';

Route::get('page/{slug}', [FrontPageController::class, 'slug'])->name('front.slug');
