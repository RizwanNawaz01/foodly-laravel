@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border-2 border-gray-200 border-dashed rounded-lg bg-white">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900">
                    {{ __('Daily Orders Report') }} ({{ $today->format('Y-m-d') }})
                </h2>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="p-6 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800">{{ __('Total Orders Today') }}</h3>
                    <p class="text-3xl font-bold mt-2 text-blue-900">{{ $totalOrders }}</p>
                </div>

                <div class="p-6 bg-green-50 border border-green-200 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800">{{ __('Total Revenue Today') }}</h3>
                    <p class="text-3xl font-bold mt-2 text-green-900">
                        {{ format_currency($totalRevenue) }}
                    </p>
                </div>
            </div>

            <!-- Orders Table -->
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">{{ __('Sno') }}</th>
                        <th class="px-6 py-3">{{ __('Order Code') }}</th>
                        <th class="px-6 py-3">{{ __('Customer') }}</th>
                        <th class="px-6 py-3">{{ __('Total Price') }}</th>
                        <th class="px-6 py-3">{{ __('Status') }}</th>
                        <th class="px-6 py-3">{{ __('Delivery') }}</th>
                        <th class="px-6 py-3">{{ __('Time') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $index => $order)
                        @php
                            $customer = json_decode($order->customerInfo);
                        @endphp

                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $orders->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $order->orderCode }}
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $customer->firstName ?? '' }} {{ $customer->lastName ?? '' }}
                                <div class="text-xs text-gray-500">
                                    {{ $customer->phoneNumber ?? '' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ format_currency($order->totalPrice) }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs rounded
                                    @if ($order->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-700
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                {{ ucfirst($order->deliveryType) }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $order->created_at->format('H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
@endsection
