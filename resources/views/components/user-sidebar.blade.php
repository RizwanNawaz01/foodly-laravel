<!-- Sidebar -->
<aside class="w-64 bg-white border-r border-gray-200 h-screen sticky top-0">
    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold text-gray-800">My Account</h2>
    </div>

    <nav class="mt-4">
        <ul class="space-y-1">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('customer.dashboard') }}"
                    class="flex items-center px-5 py-3 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ route('customer.profile') }}"
                    class="flex items-center px-5 py-3 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <span class="text-sm font-medium">Profile</span>
                </a>
            </li>

            <!-- Orders -->
            <li>
                <a href="{{ route('customer.orders') }}"
                    class="flex items-center px-5 py-3 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <span class="text-sm font-medium">Orders</span>
                </a>
            </li>

            <!-- Saved Addresses -->
            <li>
                <a href="{{ route('customer.address') }}"
                    class="flex items-center px-5 py-3 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                    <span class="text-sm font-medium">Saved Addresses</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>
