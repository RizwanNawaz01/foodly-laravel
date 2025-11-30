@extends('layouts.app')

@section('content')
    <div class="max-w-screen-xl mx-auto flex px-6 pt-20 pb-20">
        <div class="max-w-6xl w-full">
            <!-- Heading -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ __('Track Your Order') }}</h1>
                <p class="text-gray-500 mt-1">{{ __('Order #') }}{{ $order->orderCode }}</p>
            </div>

            <!-- Progress Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ __('Delivery Progress') }}</h2>
                    @php
                        $status = strtolower($order->status);
                        $badgeClasses = match ($status) {
                            'order received' => 'bg-gray-100 text-gray-700',
                            'preparing' => 'bg-yellow-100 text-yellow-700',
                            'out for delivery' => 'bg-blue-100 text-blue-700',
                            'completed' => 'bg-green-100 text-green-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                    @endphp
                    <span class="text-sm font-medium px-3 py-1 rounded-full capitalize {{ $badgeClasses }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- Progress Steps -->
                @php
                    $steps = [__('Order Received'), __('Preparing'), __('Out for Delivery'), __('Completed')];
                    $activeStep = array_search(ucfirst($order->status), $steps);
                    $activeStep = $activeStep !== false ? $activeStep : 0;
                @endphp

                <div class="relative">
                    <div class="absolute top-4 left-0 w-full h-1 bg-gray-200 rounded-full z-0"></div>
                    <div class="absolute top-4 left-0 h-1 bg-green-600 rounded-full z-0"
                        style="width: {{ ($activeStep / (count($steps) - 1)) * 100 }}%"></div>

                    <div class="flex justify-between relative z-10 mb-2">
                        @foreach ($steps as $index => $step)
                            <div class="flex flex-col items-center w-1/4">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center text-white font-semibold {{ $index <= $activeStep ? 'bg-green-600' : 'bg-gray-300' }}">
                                    {{ $index + 1 }}
                                </div>
                                <p
                                    class="text-sm mt-2 {{ $index <= $activeStep ? 'text-green-600 font-medium' : 'text-gray-400' }}">
                                    {{ $step }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Delivery Info & Order Items -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Delivery Info -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-gray-700 font-medium mb-2">{{ __('Delivery Information') }}</h3>
                        <p class="text-gray-600 text-sm mb-1">
                            <span class="font-medium">{{ __('Customer') }}:</span>
                            {{ $order->user?->name ?? $order->customerInfo['firstName'] . ' ' . $order->customerInfo['lastName'] }}
                        </p>
                        <p class="text-gray-600 text-sm mb-1">
                            <span class="font-medium">{{ __('Address') }}:</span>
                            {{ $order->customerInfo['address'] ?? 'No address provided' }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            <span class="font-medium">{{ __('Estimated Arrival') }}:</span>
                            {{ $order->eta ?? '30–45 minutes' }}
                        </p>
                    </div>

                    @if (!empty($order->notes))
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-gray-700 font-medium mb-2">{{ __('Special Notes') }}</h3>
                            <p class="text-gray-600 text-sm">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Right: Order Items -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Order Items') }}</h2>

                    @php $subtotal = 0; @endphp

                    @foreach ($order->items as $item)
                        @php
                            $itemTotal = ($item['deliveryPrice'] ?? $item['price']) * $item['quantity'];
                            $subtotal += $itemTotal;
                        @endphp
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $item['image'] ?? '/images/dishes/pizza-15.png' }}" alt=""
                                    class="w-12 h-12 rounded-md object-cover">
                                <span class="text-gray-700">{{ $item['quantity'] }} × {{ $item['name'] }}</span>
                            </div>
                            <span class="font-medium text-gray-800">{{ format_currency($itemTotal) }}</span>
                        </div>
                    @endforeach

                    <hr class="my-4">

                    <div class="flex justify-between text-gray-600 mb-1">
                        <span>{{ __('Subtotal') }}</span>
                        <span>{{ format_currency($subtotal) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600 mb-3">
                        <span>{{ __('Tax') }}</span>
                        <span>{{ format_currency($order->tax ?? 0) }}</span>
                    </div>

                    <div class="flex justify-between text-lg font-semibold text-gray-800 border-t pt-3">
                        <span>{{ __('Total') }}</span>
                        <span>{{ format_currency($subtotal + ($order->tax ?? 0)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
