@extends('layouts.app')


@section('title', $category->meta_title)
@section('meta')
    <meta name="description" content="{{ $category->meta_description }}">
    <meta name="keywords" content="{{ $category->meta_keywords }}">
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50">

        <!-- Hero Section with Background Image -->
        <section class="relative h-[400px] md:h-[500px] lg:h-[600px] overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $category->background_image) }}" alt="Hero Background"
                    class="w-full h-full object-cover">
                <!-- Overlay for better text readability -->
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 h-full flex items-center justify-center px-4">
                <div class="text-center text-white max-w-4xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 drop-shadow-lg">
                        {{ $category->name }}
                    </h1>
                    <p class="text-lg md:text-xl lg:text-2xl mb-8 drop-shadow-md">
                        {{ $category->description }}
                    </p>
                    <a href="#products"
                        class="inline-block bg-yellow-300 text-black px-8 py-3 rounded-full text-lg font-bold shadow-lg hover:bg-yellow-400 hover:scale-105 transition-all duration-200">
                        {{ __('Shop Now') }}
                    </a>
                </div>
            </div>

            <!-- Scroll Down Indicator -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="py-12 px-4 md:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">

                <!-- Section Header -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-3">
                        {{ __('Our Products') }}
                    </h2>
                    <p class="text-gray-600 text-lg">
                        {{ __('Browse our selection of quality products') }}
                    </p>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                    @foreach ($products as $product)
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md"
                            data-category="{{ strtolower($product->category->id ?? 'unknown') }}">

                            <!-- Product Image (optional) -->
                            @if ($product->image)
                                <div class="mb-3 rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="h-full w-full object-contain">
                                </div>
                            @else
                                <div class="mb-3 rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ asset('/images/dishes/demo-image.png') }}" alt="{{ $product->name }}"
                                        class="h-full w-full object-contain">
                                </div>
                            @endif

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

                <!-- Empty State -->
                @if ($products->isEmpty())
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ __('No products found') }}</h3>
                        <p class="text-gray-500">{{ __('Check back later for new arrivals') }}</p>
                    </div>
                @endif

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif

            </div>
        </section>

    </div>

    <style>
        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scroll for anchor links */
        html {
            scroll-behavior: smooth;
        }
    </style>
@endsection
