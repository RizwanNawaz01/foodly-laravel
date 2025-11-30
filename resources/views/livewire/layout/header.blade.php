<header class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50">
    <div class="app-container mx-auto flex justify-between items-center py-4 px-6">

        <!-- Logo -->
        <a href="{{ route('front.home') }}" class="text-3xl font-extrabold text-primary">
            <img src="{{ asset('storage/' . site_settings('logo', '/logo.png')) }}" alt="Logo" class="w-40">
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex space-x-6">
            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}"
                    class="text-lg font-medium text-gray-600 hover:text-white hover:bg-primary transition duration-300 px-3 py-2 rounded-lg">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">

            <!-- Language Dropdown -->
            <div class="relative hidden md:flex">
                <button wire:click="toggleLanguage"
                    class="flex items-center space-x-1 text-lg text-gray-600 hover:text-primary">
                    <span class="uppercase">{{ $currentLanguage }}</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>

                @if ($isLanguageOpen)
                    <div class="absolute right-0 mt-2 w-20 bg-white rounded-lg shadow-lg py-2 z-50">
                        <button wire:click="selectLanguage('de')"
                            class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-700">
                            {{ __('DE') }}
                        </button>
                        <button wire:click="selectLanguage('en')"
                            class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-700">
                            {{ __('EN') }}
                        </button>
                        <button wire:click="selectLanguage('fr')"
                            class="flex items-center w-full px-4 py-2 hover:bg-gray-100 text-gray-700">
                            {{ __('FR') }}
                        </button>
                    </div>
                @endif
            </div>

            <!-- Delivery Mode -->
            <button wire:click="openPostalModal"
                class="hidden md:flex items-center text-lg text-gray-700 hover:text-primary">
                @if ($deliveryMode === 'pickup')
                    <i class="fas fa-store mr-1"></i> Pickup
                @else
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ $deliveryAddress ?? 'Select Delivery Zone' }}
                @endif
            </button>

            <!-- Login / User Dropdown -->
            <div class="relative">
                @if ($user)
                    <button wire:click="toggleUserDropdown" class="hidden sm:block text-lg text-primary font-semibold">
                        👤 {{ $user->name }} ▼
                    </button>

                    @if ($isUserDropdown)
                        <div class="absolute top-full right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border z-50">
                            <div class="p-4 border-b">
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                            </div>
                            @if (!$isAdmin)
                                <a href="{{ route('customer.dashboard') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 border-b"
                                    wire:click="$set('isUserDropdown', false)">
                                    {{ __('Dashboard') }}
                                </a>

                                <a href="{{ route('customer.orders') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 border-b"
                                    wire:click="$set('isUserDropdown', false)">
                                    {{ __('Orders') }}
                                </a>
                                <a href="{{ route('customer.profile') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 border-b"
                                    wire:click="$set('isUserDropdown', false)">
                                    {{ __('Profile') }}
                                </a>
                            @endif

                            @if ($isAdmin)
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 border-b"
                                    wire:click="$set('isUserDropdown', false)">
                                    {{ __('Admin Panel') }}
                                </a>
                            @endif

                            <button wire:click="logout"
                                class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                {{ __('Logout') }}
                            </button>
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="capitalize hidden sm:block text-lg text-primary font-semibold">
                        {{ __('login') }}
                    </a>
                @endif
            </div>

            <!-- Search Button -->
            <button wire:click="openSearchModal" class="relative text-2xl text-primary hover:text-primary/80">
                <i class="iconify" data-icon="fa-solid:search" data-width="24" data-height="24"></i>
            </button>

            <!-- Cart Button -->
            <button wire:click="openModal('isCartOpen')" class="relative text-2xl text-primary hover:text-primary/80">
                <i class="iconify" data-icon="fa-solid:shopping-cart" data-width="24" data-height="24"></i>
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ $cartCount }}
                </span>
            </button>

            <!-- Mobile Menu Toggle -->
            <button wire:click="toggleMenu" class="md:hidden text-2xl text-gray-600">
                <span class="iconify text-primary" data-icon="mdi:menu" data-width="32" data-height="32"></span>
            </button>

        </div>
    </div>

    <!-- Mobile Side Panel Overlay -->
    @if ($isMenuOpen)
        <div wire:click="$set('isMenuOpen', false)"
            class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300"></div>
    @endif

    <!-- Mobile Side Panel -->
    <div
        class="md:hidden fixed top-0 right-0 h-full w-80 bg-white shadow-2xl z-50 transform transition-transform duration-300 ease-in-out {{ $isMenuOpen ? 'translate-x-0' : 'translate-x-full' }}">

        <!-- Panel Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">{{ __('Menu') }}</h2>
            <button wire:click="$set('isMenuOpen', false)" class="text-2xl text-gray-600 hover:text-gray-800">
                <span class="iconify" data-icon="mdi:close" data-width="28" data-height="28"></span>
            </button>
        </div>

        <!-- Panel Content -->
        <div class="overflow-y-auto h-full pb-20">

            <!-- User Section -->
            <div class="p-6 border-b bg-gray-50">
                @if ($user)
                    <div class="flex items-center space-x-3 mb-3">
                        <div
                            class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white text-xl">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                    @if (!$isAdmin)
                        <a href="{{ route('customer.dashboard') }}" wire:click="$set('isMenuOpen', false)"
                            class="block text-sm text-primary hover:underline mb-1">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('customer.orders') }}" wire:click="$set('isMenuOpen', false)"
                            class="block text-sm text-primary hover:underline mb-1">
                            {{ __('Orders') }}
                        </a>
                        <a href="{{ route('customer.profile') }}" wire:click="$set('isMenuOpen', false)"
                            class="block text-sm text-primary hover:underline">
                            {{ __('Profile') }}
                        </a>
                    @endif
                    @if ($isAdmin)
                        <a href="{{ route('dashboard') }}" wire:click="$set('isMenuOpen', false)"
                            class="block text-sm text-primary hover:underline">
                            {{ __('Admin Panel') }}
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" wire:click="$set('isMenuOpen', false)"
                        class="flex items-center justify-center bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary/90 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Login') }}
                    </a>
                @endif
            </div>

            <!-- Navigation Links -->
            <nav class="py-4">
                <h3 class="px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                    {{ __('Navigation') }}
                </h3>
                @foreach ($navLinks as $link)
                    <a href="{{ $link['href'] }}" wire:click="$set('isMenuOpen', false)"
                        class="block px-6 py-3 text-lg font-medium text-gray-700 hover:bg-primary hover:text-white transition">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Delivery Mode -->
            <div class="px-6 py-4 border-t border-b">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                    {{ __('Delivery') }}
                </h3>
                <button wire:click="openPostalModal"
                    class="flex items-center w-full text-left text-lg text-gray-700 hover:text-primary">
                    @if ($deliveryMode === 'pickup')
                        <i class="fas fa-store mr-2 text-primary"></i>
                        <span>{{ __('Pickup') }}</span>
                    @else
                        <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                        <span>{{ $deliveryAddress ?? __('Select Delivery Zone') }}</span>
                    @endif
                </button>
            </div>

            <!-- Language Selection -->
            <div class="px-6 py-4 border-b">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                    {{ __('Language') }}
                </h3>
                <div class="space-y-2">
                    <button wire:click="selectLanguage('de')"
                        class="flex items-center justify-between w-full px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700 {{ $currentLanguage === 'de' ? 'bg-primary/10 text-primary' : '' }}">
                        <span>{{ __('Deutsch') }}</span>
                        @if ($currentLanguage === 'de')
                            <i class="fas fa-check text-primary"></i>
                        @endif
                    </button>
                    <button wire:click="selectLanguage('en')"
                        class="flex items-center justify-between w-full px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700 {{ $currentLanguage === 'en' ? 'bg-primary/10 text-primary' : '' }}">
                        <span>{{ __('English') }}</span>
                        @if ($currentLanguage === 'en')
                            <i class="fas fa-check text-primary"></i>
                        @endif
                    </button>
                    <button wire:click="selectLanguage('fr')"
                        class="flex items-center justify-between w-full px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700 {{ $currentLanguage === 'fr' ? 'bg-primary/10 text-primary' : '' }}">
                        <span>{{ __('Français') }}</span>
                        @if ($currentLanguage === 'fr')
                            <i class="fas fa-check text-primary"></i>
                        @endif
                    </button>
                </div>
            </div>

            <!-- Logout Button -->
            @if ($user)
                <div class="px-6 py-4">
                    <button wire:click="logout"
                        class="flex items-center justify-center w-full bg-red-500 text-white font-semibold py-3 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('Logout') }}
                    </button>
                </div>
            @endif

        </div>
    </div>

</header>
