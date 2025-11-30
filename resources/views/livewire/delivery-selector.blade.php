<div>
    @if ($isOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm relative">

                <h2 class="text-xl font-semibold mb-4">{{ __('Choose Delivery Zone') }}</h2>

                <!-- Close button -->
                <button class="absolute top-5 right-4 text-gray-500 hover:text-gray-700 cursor-pointer"
                    wire:click="$set('isOpen', false)">
                    ✕
                </button>

                <!-- Select boxes -->
                <div class="flex gap-4">
                    <select wire:model.live="city" class="w-1/2 border border-gray-300 p-2 rounded bg-white">
                        <option value="">{{ __('City') }}</option>
                        @foreach ($cities as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="postalCode" class="w-1/2 border border-gray-300 p-2 rounded bg-white">
                        <option value="">{{ __('Postal Code') }}</option>
                        @foreach ($postalCodes as $p)
                            <option value="{{ $p->code }}">{{ $p->code }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex items-center gap-4">
                    <button wire:click="saveDelivery"
                        class="w-full bg-primary text-white py-2 rounded disabled:opacity-60">
                        {{ __('Save') }}
                    </button>

                    <p class="text-center">{{ __('OR') }}</p>

                    <button wire:click="savePickup"
                        class="w-full bg-primary text-white py-2 rounded disabled:opacity-60">
                        {{ __('Pickup') }}
                    </button>
                </div>

            </div>
        </div>
    @endif
</div>
