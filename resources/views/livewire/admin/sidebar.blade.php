<div class="app-container mx-auto">
    <!-- Mobile Toggle Button -->
    <button id="sidebar-toggle"
        class="fixed top-18 left-4 z-50 p-2 text-gray-500 bg-white rounded-lg shadow-lg sm:hidden hover:bg-gray-100">
        <span class="iconify" data-icon="mdi:menu" data-width="24" data-height="24"></span>
    </button>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden sm:hidden"></div>

    <!-- Sidebar -->
    <aside id="default-sidebar"
        class="fixed top-0 md:top-[100px] left-0 md:left-[250px] z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">

        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
            <!-- Close button for mobile -->
            <button id="sidebar-close"
                class="absolute top-4 right-4 p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100">
                <span class="iconify" data-icon="mdi:close" data-width="24" data-height="24"></span>
            </button>

            <ul class="space-y-2 font-medium mt-12 sm:mt-0">

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:view-dashboard" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black">Dashboard</span>
                    </a>
                </li>

                {{-- Orders --}}
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.orders') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:clipboard-list" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black flex-1">Orders</span>
                        <span
                            class="inline-flex items-center justify-center w-5 h-5 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                            {{ $ordersCount }}
                        </span>
                    </a>
                </li>


                {{-- Reports (Collapsible) --}}
                <li>
                    <button wire:click="toggleMenu('reports')"
                        class="flex items-center w-full p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                        <span class="iconify" data-icon="mdi:package-variant" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black flex-1 text-left">Reports</span>
                        @if ($openMenu === 'reports')
                            <span class="iconify" data-icon="mdi:chevron-up" data-width="20" data-height="20"></span>
                        @else
                            <span class="iconify" data-icon="mdi:chevron-down" data-width="20" data-height="20"></span>
                        @endif
                    </button>
                    @if ($openMenu === 'reports')
                        <ul class="pl-10 mt-2 space-y-1">
                            <li><a href="{{ route('admin.reports.daily-order-report') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">Daily Sales Report</a>
                            </li>
                            <li><a href="{{ route('admin.reports.category-sales-report') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">Category Sales Report</a>
                            </li>
                        </ul>
                    @endif
                </li>

                {{-- Customers --}}
                <li>
                    <a href="{{ route('admin.customer.index') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.customers') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:account-group" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black">Customers</span>
                    </a>
                </li>

                {{-- Categories --}}
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.categories') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:shape-outline" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black">Categories</span>
                    </a>
                </li>

                {{-- Products (Collapsible) --}}
                <li>
                    <button wire:click="toggleMenu('products')"
                        class="flex items-center w-full p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                        <span class="iconify" data-icon="mdi:package-variant" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black flex-1 text-left">Products</span>
                        @if ($openMenu === 'products')
                            <span class="iconify" data-icon="mdi:chevron-up" data-width="20" data-height="20"></span>
                        @else
                            <span class="iconify" data-icon="mdi:chevron-down" data-width="20" data-height="20"></span>
                        @endif
                    </button>
                    @if ($openMenu === 'products')
                        <ul class="pl-10 mt-2 space-y-1">
                            <li><a href="{{ route('admin.products.index') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">All Products</a></li>
                            <li><a href="{{ route('admin.submenus.index') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">Sub Menu List</a></li>
                        </ul>
                    @endif
                </li>

                {{-- Sliders --}}
                <li>
                    <a href="{{ route('admin.sliders.index') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.sliders') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:camera-outline" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black">Sliders</span>
                    </a>
                </li>

                {{-- Cities (Collapsible) --}}
                <li>
                    <button wire:click="toggleMenu('cities')"
                        class="flex items-center w-full p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                        <span class="iconify" data-icon="mdi:city" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black flex-1 text-left">Cities</span>
                        @if ($openMenu === 'cities')
                            <span class="iconify" data-icon="mdi:chevron-up" data-width="20"
                                data-height="20"></span>
                        @else
                            <span class="iconify" data-icon="mdi:chevron-down" data-width="20"
                                data-height="20"></span>
                        @endif
                    </button>
                    @if ($openMenu === 'cities')
                        <ul class="pl-10 mt-2 space-y-1">
                            <li><a href="{{ route('admin.cities.index') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">City List</a></li>
                            <li><a href="{{ route('admin.postal_codes.index') }}"
                                    class="block p-2 text-gray-700 rounded hover:bg-gray-100">Postal Codes</a></li>
                        </ul>
                    @endif
                </li>

                {{-- Settings --}}
                <li>
                    <a href="{{ route('admin.settings.create') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.settings') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:cog-outline" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black flex-1">Admin Settings</span>
                    </a>
                </li>

                {{-- Pages --}}
                <li>
                    <a href="{{ route('admin.pages.index') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.pages') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:file-document-outline" data-width="24"
                            data-height="24"></span>
                        <span class="ml-3 text-black flex-1">Pages</span>
                    </a>
                </li>

                {{-- About --}}
                <li>
                    <a href="{{ route('admin.about.create') }}"
                        class="flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.about') ? 'bg-gray-100' : '' }}">
                        <span class="iconify" data-icon="mdi:information-outline" data-width="24"
                            data-height="24"></span>
                        <span class="ml-3 text-black flex-1">About</span>
                    </a>
                </li>

                {{-- Sign Out --}}
                <li>
                    <button wire:click="logout"
                        class="flex items-center w-full p-2 text-gray-500 rounded-lg hover:bg-gray-100">
                        <span class="iconify" data-icon="mdi:logout" data-width="24" data-height="24"></span>
                        <span class="ml-3 text-black">Sign Out</span>
                    </button>
                </li>

            </ul>
        </div>
    </aside>
</div>

<!-- JavaScript for Toggle -->
<script>
    const sidebar = document.getElementById('default-sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const closeBtn = document.getElementById('sidebar-close');
    const overlay = document.getElementById('sidebar-overlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    toggleBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>

<!-- Iconify Script -->
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
