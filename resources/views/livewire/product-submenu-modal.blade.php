<div>
    @if ($show)
        <div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-md relative">

                <button class="absolute top-2 right-2 text-gray-500" wire:click="close">✕</button>

                <h2 class="text-xl font-bold mb-2">{{ $product['name'] }}</h2>
                <p class="text-sm text-gray-600 mb-4">{{ $product['description'] ?? '' }}</p>

                <h3 class="font-semibold mb-2">{{ __('Extra Ingredients') }}</h3>

                @foreach ($product['subMenu'] ?? [] as $extra)
                    <label class="flex items-center space-x-2 mb-1">
                        <input type="checkbox" wire:click="toggleExtra('{{ $extra['name'] }}', {{ $extra['price'] }})">
                        <span>+ {{ $extra['name'] }} ({{ format_currency($extra['price']) }})</span>
                    </label>
                @endforeach
                <hr>
                <div class="flex justify-end mt-2">
                    {{ __('Additional Cost') }} : {{ format_currency($additionalCost) }}
                </div>
                <br>
                <button class="w-full mt-4 bg-yellow-300 py-2 rounded-full font-semibold" wire:click="addToCart">
                    {{ __('Add to Cart') }}
                </button>
            </div>
        </div>
    @endif
</div>
