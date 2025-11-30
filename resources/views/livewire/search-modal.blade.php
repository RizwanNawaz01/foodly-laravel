<div>
    <!-- Modal Overlay -->
    @if ($isOpen)
        <div class="fixed inset-0 z-[100] overflow-hidden" wire:ignore.self>
            <!-- Backdrop -->
            <div wire:click="close" class="absolute inset-0 bg-black bg-opacity-60 transition-opacity duration-300">
            </div>

            <!-- Modal Container -->
            <div class="relative min-h-screen flex items-start justify-center p-4 pt-20">
                <div class="relative w-full max-w-3xl bg-white rounded-2xl shadow-2xl transform transition-all duration-300"
                    wire:click.stop>

                    <!-- Search Header -->
                    <div class="sticky top-0 bg-white rounded-t-2xl border-b border-gray-200 p-6 z-10">
                        <div class="flex items-center gap-4">
                            <!-- Search Input Container -->
                            <div class="flex-1 relative">
                                <div
                                    class="flex items-center focus-visible:no-underline bg-gray-50 rounded-xl border-2 border-gray-200 focus-within:border-primary transition-all duration-200">
                                    <input type="text" wire:model.live.debounce.300ms="searchQuery"
                                        placeholder="{{ __('Search products...') }}"
                                        class="flex-1 bg-transparent px-5 py-4 text-lg outline-none  focus:outline-none focus:ring-0 focus:border-none placeholder-gray-400 border-none">

                                    @if ($searchQuery)
                                        <button wire:click="clearSearch"
                                            class="px-3 text-gray-400 hover:text-gray-600 transition">
                                            <i class="iconify" data-icon="mdi:close-circle" data-width="24"
                                                data-height="24"></i>
                                        </button>
                                    @endif

                                    <button wire:click="search"
                                        class="bg-primary hover:bg-primary/90 text-white px-6 py-4 rounded-r-xl transition-colors duration-200">
                                        <i class="iconify" data-icon="fa-solid:search" data-width="20"
                                            data-height="20"></i>
                                    </button>
                                </div>

                                <!-- Search Indicator -->
                                @if ($isSearching)
                                    <div class="absolute right-20 top-1/2 transform -translate-y-1/2">
                                        <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-primary"></div>
                                    </div>
                                @endif
                            </div>

                            <!-- Close Button -->
                            <button wire:click="close"
                                class="md:text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 md:rounded-lg
                                relative left-[-40px] md:left-0 top-[-80px] md:top-0 text-black/25 rounded-full bg-white   md:bg-transparent
                                
                                ">
                                <i class="iconify hidden md:block" data-icon="mdi:close" data-width="28"
                                    data-height="28"></i>
                                <i class="iconify block md:hidden" data-icon="mdi:close" data-width="16"
                                    data-height="16"></i>
                            </button>
                        </div>

                        <!-- Search Info -->
                        @if ($searchQuery && count($searchResults) > 0)
                            <div class="mt-3 text-sm text-gray-500">
                                {{ count($searchResults) }} {{ __('results found for') }} "<span
                                    class="font-medium text-gray-700">{{ $searchQuery }}</span>"
                            </div>
                        @endif
                    </div>

                    <!-- Search Results -->
                    <div class="max-h-[60vh] overflow-y-auto p-6">
                        @if (strlen($searchQuery) < 2 && count($searchResults) === 0)
                            <!-- Empty State -->
                            <div class="text-center py-16">
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="iconify text-gray-400" data-icon="fa-solid:search" data-width="32"
                                        data-height="32"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                    {{ __('Start Searching') }}
                                </h3>
                                <p class="text-gray-500">
                                    {{ __('Enter at least 2 characters to search for products') }}
                                </p>
                            </div>
                        @elseif ($searchQuery && count($searchResults) === 0 && !$isSearching)
                            <!-- No Results -->
                            <div class="text-center py-16">
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                                    <i class="iconify text-gray-400" data-icon="mdi:package-variant" data-width="32"
                                        data-height="32"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                    {{ __('No Products Found') }}
                                </h3>
                                <p class="text-gray-500">
                                    {{ __('Try adjusting your search keywords') }}
                                </p>
                            </div>
                        @else
                            <!-- Results Grid -->
                            <div class="space-y-3">
                                @foreach ($searchResults as $product)
                                    <a wire:click="close"
                                        class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all duration-200 border border-transparent hover:border-gray-200 group">

                                        <!-- Product Image -->
                                        <div
                                            class="relative w-20 h-20 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                            @if ($product['image'])
                                                <img src="{{ asset('storage/' . $product['image']) }}"
                                                    alt="{{ $product['name'] }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="iconify text-gray-300" data-icon="mdi:image-off"
                                                        data-width="32" data-height="32"></i>
                                                </div>
                                            @endif

                                            @if (!$product['in_stock'])
                                                <div
                                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                                    <span
                                                        class="text-xs text-white font-semibold">{{ __('Out of Stock') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Info -->
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="font-semibold text-gray-800 group-hover:text-primary transition truncate">
                                                {{ $product['name'] }}
                                            </h4>

                                            @if ($product['category'])
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $product['category'] }}
                                                </p>
                                            @endif
                                        </div>

                                        <!-- Product Price -->
                                        <div class="text-right flex-shrink-0">

                                            <span class="text-lg font-bold text-gray-800">
                                                {{ format_currency($product['price']) }}
                                            </span>

                                        </div>


                                        <button wire:click="addToCart({{ $product['id'] }})"
                                            class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer">
                                            +
                                        </button>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Quick Suggestions (Optional) -->
                    @if (strlen($searchQuery) < 2 && count($searchResults) === 0)
                        <div class="hidden md:block border-t border-gray-200 p-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">{{ __('Popular Searches') }}</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['Pizza', 'Burger', 'Pasta', 'Salad', 'Dessert'] as $suggestion)
                                    <button wire:click="$set('searchQuery', '{{ $suggestion }}')"
                                        class="px-4 py-2 bg-gray-100 hover:bg-primary hover:text-white text-gray-700 rounded-full text-sm transition-all duration-200">
                                        {{ $suggestion }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('openSearchModal', () => {
            document.body.style.overflow = 'hidden';
        });

        window.addEventListener('close-search-modal', () => {
            document.body.style.overflow = 'auto';
        });
    });
</script>
