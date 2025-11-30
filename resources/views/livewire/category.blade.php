<div class="app-container mx-auto mt-5" x-data="{
    categories: @js($categories),
}">
    <h2 class="text-2xl md:text-3xl font-bold text-primary mb-6"> {{ __('Categories') }} </h2>
    <div class="relative mx-auto pt-5 max-w-6xl">

        <!-- Left scroll button - hidden on mobile -->
        <button @click="$refs.scroller.scrollBy({ left: -300, behavior: 'smooth' })"
            class="hidden md:block absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg hover:shadow-xl p-2 rounded-full transition-shadow">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Scrollable container -->
        <div x-ref="scroller"
            class="flex gap-4 overflow-x-auto scroll-smooth no-scrollbar py-4 px-4 md:px-10 
                   snap-x snap-mandatory md:snap-none touch-pan-x">

            <template x-for="category in categories" :key="category.id">
                <a :href="'/category/' + category.slug"
                    class="flex-shrink-0 text-center w-20 sm:w-24 md:w-28 cursor-pointer 
                           snap-center md:snap-align-none hover:scale-105 transition-transform">
                    <img :src="'/storage/' + category.image" :alt="category.name"
                        class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 object-cover rounded-full border-2 border-gray-200 mx-auto">
                    <p class="mt-2 text-xs sm:text-sm font-medium text-slate-700 line-clamp-2" x-text="category.name">
                    </p>
                </a>
            </template>
        </div>

        <!-- Right scroll button - hidden on mobile -->
        <button @click="$refs.scroller.scrollBy({ left: 300, behavior: 'smooth' })"
            class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white shadow-lg hover:shadow-xl p-2 rounded-full transition-shadow">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    <style>
        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Smooth scroll behavior for touch devices */
        @media (max-width: 768px) {
            .no-scrollbar {
                scroll-padding-left: 1rem;
            }
        }

        /* Text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

</div>
