@extends('layouts.admin')

@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg bg-white shadow-sm">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4 pt-7 mt-5">
                <h2 class="text-2xl text-slate-900 font-semibold mb-6">{{ __('Orders List') }}</h2>

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">{{ __('Customer') }}</th>
                            <th class="px-6 py-3">{{ __('Items') }}</th>
                            <th class="px-6 py-3">{{ __('Total') }}</th>
                            <th class="px-6 py-3">{{ __('Delivery Type') }}</th>
                            <th class="px-6 py-3">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <!-- Customer Name -->
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $order->user?->name ?? $order->guestName }}
                                </th>

                                <!-- Items List -->
                                <td class="px-6 py-4">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($order->items as $item)
                                            <li>
                                                {{ $item['quantity'] }} × {{ $item['name'] }}
                                                @if (!empty($item['extras']))
                                                    <div class="text-gray-500 text-sm mt-1 ml-3">
                                                        Extras:<br>
                                                        @foreach ($item['extras'] as $extra)
                                                            &nbsp;&nbsp;&nbsp;{{ $extra['name'] }}
                                                            (+{{ $extra['price'] }})
                                                            @if (!$loop->last)
                                                                ,<br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <!-- Total -->
                                <td class="px-6 py-4"> {{ format_currency($order->totalPrice) }}</td>

                                <!-- Delivery Type -->
                                <td class="px-6 py-4">{{ $order->deliveryType ?? 'delivery' }}</td>

                                <!-- Status Badge -->
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = match ($order->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'completed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium capitalize {{ $statusClasses }}">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Print -->
                                        <a href="{{ route('admin.orders.print', $order->id) }}"
                                            class="text-white flex items-center gap-1 bg-orange-500 p-2 rounded-full hover:opacity-90">
                                            <span class="iconify" data-icon="ep:printer" data-width="16"
                                                data-height="16"></span>
                                        </a>

                                        <!-- View -->
                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                            class="text-white flex items-center gap-1 bg-blue-500 p-2 rounded-full hover:opacity-90">
                                            <span class="iconify" data-icon="ep:view" data-width="16"
                                                data-height="16"></span>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-white bg-red-600 flex items-center gap-1 p-2 rounded-full hover:opacity-90">
                                                <span class="iconify" data-icon="icon-park-solid:delete-four"
                                                    data-width="16" data-height="16"></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">
                                    {{ __('No orders found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4 mb-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Iconify Script -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection
