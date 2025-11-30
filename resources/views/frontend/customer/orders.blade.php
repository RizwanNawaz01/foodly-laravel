@extends('layouts.app')

@section('content')
    <main>
        <div class="app-container py-6 md:py-10">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mx-auto px-4">

                <!-- Sidebar -->
                <div class="md:col-span-1 hidden md:block">
                    <x-user-sidebar />
                </div>

                <!-- Orders Table / Cards -->
                <div class="md:col-span-3 relative overflow-hidden shadow-md sm:rounded-lg px-3 md:px-4 pt-5 md:pt-7">

                    <!-- Header and Filter -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h2 class="text-lg md:text-xl text-slate-900 font-semibold">{{ __('Orders List') }}</h2>

                        <div class="w-full sm:w-auto">
                            <form method="GET" class="inline-block w-full sm:w-auto">
                                <select name="status" onchange="this.form.submit()"
                                    class="w-full sm:w-auto border border-gray-300 text-gray-700 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}
                                    </option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        {{ __('Completed') }}
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        {{ __('Cancelled') }}
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-3 py-3">{{ __('S.No') }}</th>
                                    <th class="px-3 py-3">{{ __('Items') }}</th>
                                    <th class="px-3 py-3">{{ __('Price') }}</th>
                                    <th class="px-3 py-3">{{ __('Delivery Type') }}</th>
                                    <th class="px-3 py-3">{{ __('Date & Time') }}</th>
                                    <th class="px-3 py-3">{{ __('Status') }}</th>
                                    <th class="px-3 py-3">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $index => $order)
                                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-3 py-4">{{ $orders->firstItem() + $index }}</td>
                                        <td class="px-3 py-4">
                                            <ul class="list-disc list-inside">
                                                @foreach ($order->items as $item)
                                                    <li>{{ $item['quantity'] }} × {{ $item['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-3 py-4">${{ number_format($order->totalPrice, 2) }}</td>
                                        <td class="px-3 py-4">{{ ucfirst($order->deliveryType ?? 'delivery') }}</td>
                                        <td class="px-3 py-4">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                        @php
                                            $statusClasses = match ($order->status) {
                                                'pending' => 'bg-yellow-100 text-yellow-700',
                                                'completed' => 'bg-green-100 text-green-700',
                                                'cancelled' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp
                                        <td class="px-3 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium capitalize {{ $statusClasses }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-3 py-4">
                                            <a href="{{ route('front.orders_track', $order->orderCode) }}"
                                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-full capitalize">
                                                {{ __('Track Order') }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-gray-500 py-8">
                                            {{ __('No orders found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-4">
                        @forelse ($orders as $index => $order)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="text-sm font-semibold text-gray-700">
                                        {{ __('Order') }} #{{ $orders->firstItem() + $index }}
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium capitalize 
                                    {{ match ($order->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    } }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <div class="text-xs text-gray-500 uppercase mb-1">{{ __('Items') }}</div>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        @foreach ($order->items as $item)
                                            <li>{{ $item['quantity'] }} × {{ $item['name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="grid grid-cols-2 gap-3 mb-3">
                                    <div>
                                        <div class="text-xs text-gray-500 uppercase mb-1">{{ __('Price') }}</div>
                                        <div class="text-sm font-semibold text-gray-900">
                                            ${{ number_format($order->totalPrice, 2) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 uppercase mb-1">{{ __('Delivery Type') }}</div>
                                        <div class="text-sm text-gray-700">
                                            {{ ucfirst($order->deliveryType ?? 'delivery') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-xs text-gray-500 uppercase mb-1">{{ __('Date & Time') }}</div>
                                    <div class="text-sm text-gray-700">
                                        {{ $order->created_at->format('d-m-Y H:i') }}
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <a href="{{ route('front.orders_track', $order->orderCode) }}"
                                        class="block w-full text-center bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg capitalize">
                                        {{ __('Track Order') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8 bg-white rounded-lg border border-gray-200">
                                {{ __('No orders found') }}
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 mb-4 md:mb-6 flex justify-center">
                        {{ $orders->withQueryString()->links() }}
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection
