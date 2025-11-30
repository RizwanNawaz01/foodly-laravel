<!-- Menu  -->
        <section id="menu" class="pt-12 md:pt-20 pb-0 md:pb-8 px-4 sm:px-6 lg:px-8 scroll-mt-16 bg-white">
                <div class="app-container mx-auto max-w-7xl">
                    <h2 class="text-2xl md:text-3xl font-bold text-primary mb-6"> Unsere Speisekarte </h2>
                    <!-- Category Buttons -->
                    <div id="categoryButtons" class="flex overflow-x-auto snap-x snap-mandatory gap-3 sm:gap-4 px-1 sm:px-2 py-2 -mx-1 sm:-mx-2">
                    <button data-category="all" class="menu-btn bg-primary text-white shadow-md scale-[1.03] px-4 py-2 rounded-full border border-primary transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Alle </button>
                    <button data-category="pizza" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Pizza </button>
                    <button data-category="pide" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Pide </button>
                    <button data-category="snacks" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Warme Snacks </button>
                    <button data-category="salads" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Salate </button>
                    <button data-category="dessert" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Dessert </button>
                    <button data-category="drinks" class="menu-btn bg-white text-gray-700 border-gray-300 hover:border-primary/50 px-4 py-2 rounded-full border transition-all duration-150 snap-start whitespace-nowrap cursor-pointer"> Getränke </button>
                    </div>
                    <!-- Grid -->
                    <div class="relative">
                    <div id="menuGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 px-1 sm:px-2 py-6">
                        <!-- Pizza Items -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="pizza">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1"> Pizza Margherita </h3>
                            <p class="text-xs text-gray-600 line-clamp-2"> Tomatensauce, Mozzarella, Oregano </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">15.50 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="pizza">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1"> Pizza Prosciutto </h3>
                            <p class="text-xs text-gray-600 line-clamp-2"> Tomatensauce, Mozzarella, Schinken, Oregano </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">18.50 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <!-- Pide Items -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="pide">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1"> Pide mit Käse </h3>
                            <p class="text-xs text-gray-600 line-clamp-2"> Fladenbrot mit Käsefüllung </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">14.00 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <!-- Snacks -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="snacks">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1">Pommes Frites</h3>
                            <p class="text-xs text-gray-600 line-clamp-2"> Knusprige Pommes, serviert mit Dip </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">8.00 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <!-- Salad -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="salads">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1">Griechischer Salat</h3>
                            <p class="text-xs text-gray-600 line-clamp-2"> Feta, Tomaten, Gurken, Oliven </p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">12.00 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <!-- Dessert -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="dessert">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1">Tiramisu</h3>
                            <p class="text-xs text-gray-600 line-clamp-2">Klassisches italienisches Dessert</p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">9.50 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                        <!-- Drinks -->
                        <div class="menu-item bg-white rounded-lg p-3 shadow-sm border border-gray-200 flex flex-col justify-between transition-all duration-150 hover:-translate-y-0.5 hover:shadow-md" data-category="drinks">
                        <div>
                            <h3 class="text-sm font-semibold text-primary mb-1">Cola 0.5L</h3>
                            <p class="text-xs text-gray-600 line-clamp-2">Erfrischungsgetränk</p>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm font-medium text-primary">3.50 CHF</span>
                            <button class="bg-yellow-300 text-black px-3 py-1 rounded-full text-sm font-bold shadow hover:scale-105 active:scale-95 active:bg-yellow-400 transition-all duration-150 ease-in-out cursor-pointer"  id="openModalBtn"> + </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </section>
    <!-- Menu  -->