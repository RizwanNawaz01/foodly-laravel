@extends('layouts.admin')
@section('content')
    <livewire:admin.sidebar />

    <div class="p-4 sm:ml-64 lg:ml-80">
        <div class="p-6 border border-gray-300 rounded-lg shadow-sm bg-white">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-slate-900">{{ __('Order Details') }}</h2>
                <div class="flex gap-2">
                    <button onclick="printOrder()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ __('Print') }}
                    </button>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="px-3 py-2 border rounded bg-white">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}
                            </option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>
                                {{ __('Completed') }}</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                                {{ __('Cancelled') }}</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>{{ __('Order Code') }}:</strong> {{ $order->orderCode }}</p>
                        <p><strong>{{ __('Status') }}:</strong> {{ $order->status }}</p>
                        <p><strong>{{ __('Delivery Type') }}:</strong> {{ $order->deliveryType ?? 'delivery' }}</p>
                        <p><strong>{{ __('Total') }}:</strong> {{ format_currency($order->totalPrice) }}</p>
                    </div>

                    @if ($order->customerInfo)
                        <div>
                            <h3 class="text-xl font-medium mb-2">Customer Information</h3>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($order->customerInfo as $key => $value)
                                    <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @if (count($order->items))
                    <div>
                        <h3 class="text-xl font-medium mb-2">Items</h3>
                        <table class="w-full border border-gray-200 rounded text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 border-b">{{ __('Product') }}</th>
                                    <th class="px-4 py-2 border-b">{{ __('Quantity') }}</th>
                                    <th class="px-4 py-2 border-b">{{ __('Extras') }}</th>
                                    <th class="px-4 py-2 border-b">{{ __('Price') }}</th>
                                    <th class="px-4 py-2 border-b">{{ __('Notes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b">{{ $item['name'] }}</td>
                                        <td class="px-4 py-2 border-b">{{ $item['quantity'] }}</td>
                                        <td class="px-4 py-2 border-b">
                                            @if (!empty($item['extras']))
                                                @foreach ($item['extras'] as $extra)
                                                    <div class="text-sm text-gray-600">{{ $extra['name'] }}
                                                        (+{{ number_format($extra['price'], 2) }})
                                                    </div>
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border-b">{{ number_format($item['price'] ?? 0, 2) }}</td>
                                        <td class="px-4 py-2 border-b">{{ $item['note'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        {{ __('Back to Orders') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printOrder() {
            // Pass PHP data to JS
            const order = @json($order);

            let extrasHTML = '';
            order.items.forEach(item => {
                if (item.extras && item.extras.length > 0) {
                    extrasHTML += '<tr><td colspan="3" style="font-size:12px; color:#666;">Extras:<br>';
                    item.extras.forEach(extra => {
                        extrasHTML +=
                            `&nbsp;&nbsp;&nbsp;${extra.name} (+${parseFloat(extra.price).toFixed(2)})<br>`;
                    });
                    extrasHTML += '</td></tr>';
                }
            });

            let itemsHTML = '';
            order.items.forEach(item => {
                itemsHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>${parseFloat(item.price).toFixed(2)}</td>
            </tr>
        `;
            });

            const orderHTML = `
        <html>
        <head>
            <title>Order Receipt - ${order.orderCode}</title>
            <style>
                body { font-family: Arial,sans-serif; max-width:400px; margin:0 auto; padding:20px; color:#222 }
                h2,h3 { text-align:center; margin:0 }
                h2 { font-size:20px; margin-bottom:5px }
                h3 { font-size:16px; margin-top:10px; border-bottom:1px dashed #aaa; padding-bottom:4px }
                table { width:100%; border-collapse:collapse; margin-top:10px }
                td,th { padding:6px 4px; font-size:14px }
                th { text-align:left; border-bottom:1px dashed #999 }
                tr td:last-child { text-align:right }
                .total { border-top:2px solid #000; font-weight:bold }
                .footer { margin-top:20px; text-align:center; font-size:12px; color:#666 }
            </style>
        </head>
        <p>
            <h2>Order Receipt</h2>
            <p style="text-align:center; font-size:13px; color:#555;">Order Code: ${order.orderCode}</p>
            <div class="info">
                <h3>Customer Information</h3>
                ${Object.entries(order.customerInfo || {}).map(([key, value]) => ` < p > < strong > $ {
                key.replace('_', ' ').toUpperCase()
            }: < /strong> ${value}</p > `).join('')}
            </div>

            <h3>Items</h3>
            <table>
                <thead>
                    <tr><th>Item</th><th>Qty</th><th>Price</th></tr>
                </thead>
                <tbody>
                    ${itemsHTML}
                    ${extrasHTML}
                    <tr class="total">
                        <td colspan="2">Total</td>
                        <td>${parseFloat(order.totalPrice).toFixed(2)}</td>
                    </tr>
                </tbody>
            </table>

            <div class="footer">
                <p>Thank you for your order!</p>
                <p>${new Date().toLocaleString()}</p>
            </div>
        </p>
        </html>
    `;

            const printWindow = window.open('', '', 'width=400,height=600');
            if (printWindow) {
                printWindow.document.write(orderHTML);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        }
    </script>


    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
@endsection
