<section id="menu" class="pt-12 md:pt-20 pb-0 md:pb-8 px-4 sm:px-6 lg:px-8 scroll-mt-16 bg-white">
    <div class="app-container mx-auto max-w-7xl">

        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-6">{{ __(' Unsere Speisekarte') }}</h2>

        <!-- Category Buttons -->
        <div id="categoryButtons"
            class="flex overflow-x-auto snap-x snap-mandatory gap-3 sm:gap-4 px-1 sm:px-2 py-2 -mx-1 sm:-mx-2">

            <!-- ALL button -->
            <button data-category="all"
                class="menu-btn bg-primary text-white border border-primary shadow-md scale-[1.03] px-4 py-2 rounded-full transition-all duration-150 snap-start whitespace-nowrap cursor-pointer">
                {{ __('Alle') }}
            </button>

            <!-- Dynamic category buttons -->
            @foreach ($categories as $category)
                <button data-category="{{ strtolower($category->id) }}"
                    class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Product Grid -->
        <div class="relative">
            <div id="menuGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 px-1 sm:px-2 py-6">

                @foreach ($products as $product)
                    <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md"
                        data-category="{{ strtolower($product->category->id ?? 'unknown') }}">

                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1">
                                {{ $product->name }}
                            </h3>

                            <p class="text-xs text-gray-600 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">
                                {{ format_currency($product->price_delivery) }}
                            </span>

                            <button wire:click="addToCart({{ $product->id }})"
                                class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer">
                                +
                            </button>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.menu-btn');
        const menuItems = document.querySelectorAll('.menu-item');
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const selectedCategory = this.getAttribute('data-category');
                // Update button styles
                categoryButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-white', 'border-primary',
                        'shadow-md', 'scale-[1.03]');
                    btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
                });

                // Add active styles to clicked button
                this.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
                this.classList.add('bg-primary', 'text-white', 'border-primary', 'shadow-md',
                    'scale-[1.03]');

                // Filter menu items
                menuItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (selectedCategory === 'all' || itemCategory ===
                        selectedCategory) {
                        item.style.display = 'flex';
                        // Add fade-in animation
                        item.style.animation = 'fadeIn 0.3s ease-in';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });

    // CSS animation for fade-in effect
    const style = document.createElement('style');
    style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
    document.head.appendChild(style);
</script>
