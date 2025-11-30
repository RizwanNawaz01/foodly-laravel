 <!-- Highlights -->
 <section id="highlights" class="pt-12 md:pt-12 pb-0 md:pb-0 px-4 sm:px-6 lg:px-8 bg-white scroll-mt-20">
     <div class="app-container">
         <h2 class="text-2xl md:text-3xl font-bold text-primary mb-6"> {{ __('Highlights') }} </h2>
         <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
             @foreach ($products as $product)
                 <div
                     class="bg-white rounded-2xl p-3 sm:p-4 shadow-sm border border-gray-200 flex flex-col justify-between transition-all hover:-translate-y-0.5 hover:shadow-md">
                     <div>
                         <div class="w-full mb-3 overflow-hidden rounded-xl">
                             <div class="aspect-square w-full">
                                 <img alt="Cheeseburger" class="h-full w-full object-contain"
                                     src="{{ asset('storage/' . $product->image) }}">
                             </div>
                         </div>
                         <h3 class="text-sm sm:text-base font-semibold text-gray-900 mb-1 line-clamp-2">
                             {{ $product->name }} </h3>
                         <p class="text-xs sm:text-sm text-gray-600 line-clamp-2"> {{ $product->description }} </p>
                     </div>
                     <div class="mt-3 sm:mt-4 flex justify-between items-center">
                         <span class="text-sm sm:text-base font-bold text-primary">
                             {{ format_currency($product->price_delivery) }} </span>
                         <button wire:click="addToCart({{ $product->id }})"
                             class="bg-oil text-black px-3 py-1.5 bg-yellow-300  rounded-full text-xs sm:text-sm font-semibold shadow hover:scale-105 hover:bg-yellow-300 active:scale-95 active:bg-yellow-400 transition"
                             title="Add to Cart"> + </button>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
 <!-- Highlights -->
