@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl max-lg:max-w-xl mx-auto flex px-6 pt-20 pb-20">
        <div class="max-w-6xl w-full">
            <!-- Heading -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ __('Thank You for Your Order!') }}</h1>
                <p class="text-gray-500 mt-1">{{ __('Order #') }} {{ $order->orderCode }}</p>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Section -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Order Status Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ __('Order Received') }}</h2>
                        <p class="text-gray-500 mb-4">
                            {{ __('From') }}
                            {{ $order->user?->name ?? $order->customerInfo['firstName'] . ' ' . $order->customerInfo['lastName'] }}
                        </p>

                        <!-- Progress Bar -->
                        <div class="flex items-center space-x-2 mb-6">
                            <div class="flex-1 h-1 bg-green-500 rounded-full"></div>
                            <div class="flex-1 h-1 bg-gray-200 rounded-full"></div>
                            <div class="flex-1 h-1 bg-gray-200 rounded-full"></div>
                            <div class="flex-1 h-1 bg-gray-200 rounded-full"></div>
                        </div>

                        <!-- Estimate -->
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">{{ __('Estimated arrival time') }}</p>
                                <p class="font-medium text-gray-800">{{ $order->eta ?? '30–45 minutes' }}</p>
                            </div>
                            <a href="{{ route('front.orders_track', $order->orderCode) }}"
                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
                                {{ __('Track order') }}
                            </a>
                        </div>
                    </div>

                    <!-- Address Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-gray-700 font-medium mb-1">{{ __('Order Address') }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ $order->customerInfo['address'] ?? 'No address provided' }}
                        </p>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Order Details') }}</h2>

                    @php
                        $subtotal = 0;
                    @endphp

                    @foreach ($order->items as $item)
                        @php
                            $itemTotal = ($item['deliveryPrice'] ?? $item['price']) * $item['quantity'];
                            $subtotal += $itemTotal;
                        @endphp
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $item['image'] ?? '/images/dishes/pizza-15.png' }}" alt=""
                                    class="w-12 h-12 rounded-md object-cover" />
                                <span>{{ $item['quantity'] }} × {{ $item['name'] }}</span>
                            </div>
                            <span class="font-medium">{{ format_currency($itemTotal, 2) }}</span>
                        </div>
                    @endforeach

                    <hr class="my-4" />

                    <div class="flex justify-between text-gray-600 mb-1">
                        <span>{{ __('Subtotal') }}</span>
                        <span>{{ format_currency($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600 mb-3">
                        <span>{{ __('Tax') }}</span>
                        <span>{{ format_currency($order->tax ?? 0, 2) }}</span>
                    </div>

                    <div class="flex justify-between text-lg font-semibold text-gray-800 border-t pt-3">
                        <span>{{ __('Total') }}</span>
                        <span>{{ format_currency($subtotal + ($order->tax ?? 0), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
