<main class="bg-purple-50 sm:px-8 px-4 py-6">
    <div class="max-w-screen-xl mx-auto grid lg:grid-cols-2 gap-8 gap-y-12">

        <!-- Delivery Details Form -->
        <div class="max-w-4xl w-full h-max rounded-md bg-white p-6">
            <form>
                <h2 class="text-xl text-slate-900 font-semibold mb-6">{{ __('Delivery Details') }}</h2>

                <div class="grid lg:grid-cols-2 gap-y-6 gap-x-4">
                    <!-- First Name -->
                    <div>
                        <label class="text-sm font-medium block mb-2">{{ __('First Name') }}</label>
                        <input type="text" wire:model="firstName" name="firstName"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                            required />
                        @error('firstName')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="text-sm font-medium block mb-2">{{ __('Last Name') }}</label>
                        <input type="text" wire:model="lastName" name="lastName"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                            required />
                        @error('lastName')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium block mb-2">{{ __('Email') }}</label>
                        <input type="email" wire:model="email" name="email" {{ $disabledEmail ? 'disabled' : '' }}
                            class="w-full px-4 py-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-primary focus:border-transparent"
                            required />
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div wire:ignore>
                        <label class="text-sm font-medium block mb-2">{{ __('Phone Number') }}</label>
                        <input type="tel" id="phone" wire:model.defer="phoneNumber" name="phoneNumber"
                            value="{{ $phoneNumber }}"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                            required />
                        @error('phoneNumber')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Address -->
                    @if ($deliveryType === 'delivery')
                        <div>
                            <label class="text-sm font-medium block mb-2">{{ __('Address') }}</label>
                            <input type="text" wire:model="address" name="address"
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                required />
                            @error('address')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- Street -->
                    @if ($deliveryType === 'delivery')
                        <div>
                            <label class="text-sm font-medium block mb-2">{{ __('Street') }}</label>
                            <input type="text" wire:model="street" name="street"
                                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-primary focus:border-transparent"
                                required />
                            @error('street')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- City -->
                    @if ($deliveryType === 'delivery')
                        <div>
                            <label class="text-sm font-medium block mb-2">{{ __('City') }}</label>
                            <select wire:model.live="city" wire:change="handleCityChange" name="city"
                                class="w-full px-4 py-2 border rounded-md bg-white focus:ring-2 focus:ring-primary focus:border-transparent"
                                required>
                                <option value="">{{ __('Select City') }}</option>
                                @foreach ($cities as $cityOption)
                                    <option value="{{ $cityOption->id }}">{{ $cityOption->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <!-- Postal Code -->
                    @if ($deliveryType === 'delivery')
                        <div>
                            <label class="text-sm font-medium block mb-2">{{ __('Postal Code') }}</label>
                            <select wire:model="postalCode" name="postalCode"
                                class="w-full px-4 py-2 border rounded-md bg-white focus:ring-2 focus:ring-primary focus:border-transparent"
                                required>
                                <option value="">{{ __('Select Postal Code') }}</option>
                                @foreach ($postalCodes as $postal)
                                    <option value="{{ $postal->code }}">{{ $postal->code }}</option>
                                @endforeach
                            </select>
                            @error('postalCode')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                <!-- Payment Section -->
                <div class="mt-10">
                    <h2 class="text-xl text-slate-900 font-semibold mb-6">{{ __('Payment') }}</h2>

                    <div class="flex gap-4 flex-wrap mb-8">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="pay-method" checked readonly />
                            {{ __('Cash on Delivery') }}
                            <img src="{{ asset('images/cash-on-delivery.jpg') }}" alt="COD" width="80"
                                height="40" class="object-contain" />
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 max-lg:flex-col mt-8">
                        <a href="{{ route('front.home') }}"
                            class="rounded-md px-4 py-2.5 text-center w-full text-sm font-medium tracking-wide bg-gray-200 hover:bg-gray-300 border border-gray-300 text-slate-900">
                            {{ __('Continue Shopping') }}
                        </a>

                        <button type="submit" wire:loading.attr="disabled" {{ count($items) === 0 ? 'disabled' : '' }}
                            class="rounded-md px-4 py-2.5 w-full text-sm font-medium tracking-wide bg-primary hover:bg-primary/90 text-white disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="submitOrder">{{ __('Complete Purchase') }}</span>
                            <span wire:loading wire:target="submitOrder">{{ __('Processing...') }}</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="max-lg:-order-1">
            <h2 class="text-xl text-slate-900 font-semibold mb-6">{{ __('Order Summary') }}</h2>

            <!-- Delivery / Pickup Toggle -->
            <div class="mt-3 mb-6 flex gap-2">
                <button wire:click="setDeliveryType('delivery')"
                    class="flex-1 rounded-full px-3 py-1.5 text-sm font-medium transition
                        {{ $deliveryType === 'delivery' ? 'bg-primary hover:bg-primary/90 text-white' : 'border border-gray-300 bg-white text-gray-700 hover:border-primary/50' }}">
                    {{ __('Delivery') }}
                </button>
                <button wire:click="setDeliveryType('pickup')"
                    class="flex-1 rounded-full px-3 py-1.5 text-sm font-medium transition
                        {{ $deliveryType === 'pickup' ? 'bg-primary hover:bg-primary/90 text-white' : 'border border-gray-300 bg-white text-gray-700 hover:border-primary/50' }}">
                    {{ __('Pickup') }}
                </button>
            </div>

            <!-- Order Items -->
            <div class="relative bg-white border border-gray-300 rounded-md">
                <div class="px-6 py-8 md:overflow-auto">
                    <div class="space-y-4">

                        @if (count($items) === 0)
                            <p class="text-center text-gray-500 py-4">{{ __('Your cart is empty') }}</p>
                        @endif

                        @foreach ($items as $index => $item)
                            <div>
                                <div class="flex gap-4 max-sm:flex-col">
                                    <!-- Item Image -->
                                    <div class="w-24 h-24 shrink-0 bg-purple-50 p-2 rounded-md relative">
                                        @if ($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                alt="{{ $item['name'] }}" class="w-full h-full object-contain" />
                                        @else
                                            <img src="{{ asset('/images/dishes/demo-image.png') }}"
                                                alt="{{ $item['name'] }}" class="w-full h-full object-contain" />
                                        @endif
                                    </div>

                                    <!-- Item Details -->
                                    <div class="w-full flex justify-between gap-4">
                                        <div>
                                            <h3 class="text-sm font-medium text-slate-900">{{ $item['name'] }}</h3>

                                            <!-- Extras -->
                                            @if (!empty($item['extras']))
                                                @foreach ($item['extras'] as $extra)
                                                    <p class="text-xs text-green-700 flex items-center gap-1">
                                                        <span class="font-bold">+</span>
                                                        {{ $extra['name'] }} ({{ number_format($extra['price'], 2) }})
                                                    </p>
                                                @endforeach
                                            @endif

                                            <h6 class="text-[15px] text-slate-900 font-semibold mt-2">
                                                {{ number_format($item['price'], 2) }}
                                            </h6>
                                        </div>

                                        <!-- Remove + Quantity -->
                                        <div class="flex flex-col justify-between items-end gap-4">
                                            <div>
                                                <svg wire:click="removeItem('{{ $index }}')"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-4 fill-red-500 inline cursor-pointer"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z">
                                                    </path>
                                                    <path
                                                        d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z">
                                                    </path>
                                                </svg>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div
                                                class="flex items-center px-2.5 py-1.5 border border-gray-400 text-slate-900 text-xs font-medium outline-0 bg-transparent rounded-md">
                                                <button type="button"
                                                    wire:click="decreaseQuantity('{{ $index }}')"
                                                    class="cursor-pointer border-0 outline-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current"
                                                        viewBox="0 0 124 124">
                                                        <path
                                                            d="M112 50H12C5.4 50 0 55.4 0 62s5.4 12 12 12h100c6.6 0 12-5.4 12-12s-5.4-12-12-12z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <span class="mx-3">{{ $item['quantity'] }}</span>
                                                <button type="button"
                                                    wire:click="increaseQuantity('{{ $index }}')"
                                                    class="cursor-pointer border-0 outline-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2.5 fill-current"
                                                        viewBox="0 0 42 42">
                                                        <path
                                                            d="M37.059 16H26V4.941C26 2.224 23.718 0 21 0s-5 2.224-5 4.941V16H4.941C2.224 16 0 18.282 0 21s2.224 5 4.941 5H16v11.059C16 39.776 18.282 42 21 42s5-2.224 5-4.941V26h11.059C39.776 26 42 23.718 42 21s-2.224-5-4.941-5z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($index !== count($items) - 1)
                                    <hr class="border-gray-300 my-6" />
                                @endif
                            </div>
                        @endforeach

                        <!-- Totals -->
                        @if (count($items) > 0)
                            <hr class="border-gray-300 my-6" />
                            <ul class="text-slate-500 font-medium space-y-4">
                                <li class="flex flex-wrap gap-4 text-sm">
                                    {{ __('Subtotal') }} <span
                                        class="ml-auto font-semibold text-slate-900">{{ format_currency($subtotal) }}</span>
                                </li>
                                <li class="flex flex-wrap gap-4 text-sm">
                                    {{ __('Shipping') }} <span
                                        class="ml-auto font-semibold text-slate-900">{{ format_currency($shipping) }}</span>
                                </li>
                                <li class="flex flex-wrap gap-4 text-sm">
                                    {{ __('Tax') }} <span
                                        class="ml-auto font-semibold text-slate-900">{{ format_currency($tax) }}</span>
                                </li>
                                <hr class="border-slate-300" />
                                <li class="flex flex-wrap gap-4 text-[15px] font-semibold text-slate-900 capitalize">
                                    {{ __('Total') }} <span
                                        class="ml-auto">{{ format_currency($totalPrice) }}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector("#phone");

        if (!phoneInput) {
            console.log("Phone input not found");
            return;
        }

        // Get initial value from Livewire
        let initialValue = @json($phoneNumber ?? '');

        // Initialize intl-tel-input
        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            initialCountry: "de",
            preferredCountries: ["de", "at", "ch", "pk"],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.min.js",
            autoPlaceholder: "polite",
            formatOnDisplay: true,
            nationalMode: false
        });

        window.itiInstance = iti;

        // Set initial value
        if (initialValue && initialValue.trim()) {
            iti.setNumber(initialValue);
        }

        console.log("intl-tel-input initialized");

        // Sync function
        function syncToLivewire() {
            // Get the selected country data
            const countryData = iti.getSelectedCountryData();
            const dialCode = countryData.dialCode;

            // Get the raw input value (what user typed)
            const rawValue = phoneInput.value.trim();

            // Try to get full international number first
            let fullNumber = iti.getNumber();

            // If getNumber() returns empty but we have a value, build it manually
            if (!fullNumber && rawValue) {
                fullNumber = '+' + dialCode + rawValue.replace(/\D/g, '');
            }

            if (fullNumber && typeof @this !== 'undefined') {
                @this.phoneNumber = fullNumber;
            }
        }

        // Debounce function
        let typingTimer;
        const typingDelay = 500;

        // Sync on input with debounce
        phoneInput.addEventListener('input', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(syncToLivewire, typingDelay);
        });

        // Sync immediately on blur
        phoneInput.addEventListener('blur', function() {
            clearTimeout(typingTimer);
            syncToLivewire();
        });

        // Sync on country change
        phoneInput.addEventListener('countrychange', function() {
            syncToLivewire();
        });

        // CRITICAL: Intercept form submission
        const form = phoneInput.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                // Force final sync
                const countryData = iti.getSelectedCountryData();
                const dialCode = countryData.dialCode;
                const rawValue = phoneInput.value.trim();
                let fullNumber = iti.getNumber();

                if (!fullNumber && rawValue) {
                    fullNumber = '+' + dialCode + rawValue.replace(/\D/g, '');
                }

                if (fullNumber && typeof @this !== 'undefined') {
                    @this.phoneNumber = fullNumber;

                    // Wait for sync then submit
                    setTimeout(function() {
                        @this.call('submitOrder');
                    }, 150);
                } else {
                    alert("Please enter a valid phone number");
                }
            });
        }
    });
</script>
