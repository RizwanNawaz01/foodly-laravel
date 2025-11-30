<div>
    @if ($isOpen)
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" wire:click="close"></div>

        <!-- Cart Sidebar -->
        <aside
            class="fixed right-0 top-4 bottom-4 w-[92vw] max-w-sm sm:top-0 sm:bottom-0 sm:w-96 bg-white rounded-l-2xl sm:rounded-none shadow-xl z-50 transform transition-transform duration-300">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h2 class="text-lg font-semibold text-primary capitalize">
                    {{ __('Cart') }}
                </h2>
                <button wire:click="close" class="text-gray-500 hover:text-gray-700 text-2xl leading-none cursor-pointer">
                    ×
                </button>
            </div>

            <!-- Cart Content -->
            <div class="h-[calc(100%-56px)] overflow-y-auto p-4">
                <div class="w-full max-w-md h-full flex flex-col">

                    <!-- Delivery Type Toggle -->
                    <div class="mt-3 mb-4 flex gap-2">
                        <button wire:click="setDeliveryType('delivery')"
                            class="flex-1 rounded-full px-3 py-1.5 text-sm font-medium transition capitalize
                                {{ $deliveryType === 'delivery' ? 'bg-primary hover:bg-primary/90 text-white' : 'border border-gray-300 bg-white text-gray-700 hover:border-primary/50' }}">
                            {{ __('Delivery') }}
                        </button>

                        <button wire:click="setDeliveryType('pickup')"
                            class="flex-1 rounded-full px-3 py-1.5 text-sm font-medium transition capitalize
                                {{ $deliveryType === 'pickup' ? 'bg-primary hover:bg-primary/90 text-white' : 'border border-gray-300 bg-white text-gray-700 hover:border-primary/50' }}">
                            {{ __('Pickup') }}
                        </button>
                    </div>

                    <!-- Cart Items -->
                    <ul class="space-y-3 flex-1 overflow-y-auto pr-1">
                        @if (count($items) === 0)
                            <li class="text-sm text-gray-600">{{ __('Your cart is empty') }}</li>
                        @endif

                        @foreach ($items as $itemId => $item)
                            <li class="border border-gray-300 p-2 rounded text-sm">
                                <!-- Item Header -->
                                <div class="flex justify-between">
                                    <div>
                                        <div class="font-medium">
                                            {{ $item['name'] }} x {{ $item['quantity'] }}
                                        </div>

                                        <!-- Extras -->
                                        @if (!empty($item['extras']))
                                            @foreach ($item['extras'] as $extra)
                                                <p class="text-xs text-green-700 flex items-center gap-1">
                                                    <span class="font-bold">+</span>
                                                    {{ $extra['name'] }} (
                                                    {{ format_currency($extra['price'], 2) }})
                                                </p>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="font-semibold">
                                        {{ format_currency($this->getItemTotal($item)) }}
                                    </div>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center mt-2 gap-2">
                                    <button wire:click="decrease('{{ $itemId }}')"
                                        class="px-2 py-1 border border-gray-300 rounded text-xs hover:bg-gray-50">
                                        –
                                    </button>

                                    <span>{{ $item['quantity'] }}</span>

                                    <button wire:click="increase('{{ $itemId }}')"
                                        class="px-2 py-1 border border-gray-300 rounded text-xs hover:bg-gray-50">
                                        +
                                    </button>

                                    <button wire:click="remove('{{ $itemId }}')"
                                        class="ml-auto text-red-500 text-xs hover:underline capitalize">
                                        {{ __('Remove') }}
                                    </button>
                                </div>

                                <!-- Note -->
                                <textarea wire:model.blur="items.{{ $itemId }}.note"
                                    wire:change="updateNote('{{ $itemId }}', $event.target.value)" placeholder="Note (optional)" rows="1"
                                    class="mt-2 w-full border border-gray-300 p-1 text-xs rounded focus:ring-1 focus:ring-primary focus:border-primary">{{ $item['note'] ?? '' }}</textarea>

                                @if (!empty($item['note']))
                                    <button wire:click="clearNote('{{ $itemId }}')"
                                        class="text-red-500 text-xs mt-1 hover:underline capitalize">
                                        {{ __('Clear note') }}
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <!-- Footer -->
                    <div class="mt-4 space-y-2 border-t pt-4">
                        <p class="text-right font-bold text-lg">
                            {{ __('Total') }}: {{ format_currency($totalPrice) }}
                        </p>
                        <p class="text-right text-xs text-gray-500">
                            ({{ __('Including 5% tax') }})
                        </p>

                        <a href="{{ route('front.checkout') }}" wire:click="close"
                            class="w-full bg-primary hover:bg-primary/90 text-white py-2 rounded block text-center capitalize font-semibold transition">
                            {{ __('Checkout') }}
                        </a>

                        <button wire:click="clearCart" class="w-full text-sm text-gray-500 hover:underline capitalize">
                            {{ __('Clear cart') }}
                        </button>
                    </div>
                </div>
            </div>
        </aside>
    @endif
</div>
