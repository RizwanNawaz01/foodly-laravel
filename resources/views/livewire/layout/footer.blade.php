<footer class="bg-gray-100 py-8">

    <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

        <!-- Quick Links -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="#home" class="text-gray-600 hover:text-primary">Home</a></li>
                <li><a href="#highlights" class="text-gray-600 hover:text-primary">Highlights</a></li>
                <li><a href="#menu" class="text-gray-600 hover:text-primary">Menu</a></li>
                <li><a href="#about" class="text-gray-600 hover:text-primary">About</a></li>
            </ul>
        </div>

        <!-- Contact Details -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Our Contact Details</h3>
            <ul class="space-y-2">
                <li>
                    <a href="tel:{{ $settings->contact }}" class="text-gray-600 hover:text-primary">
                        {{ $settings->contact }}
                    </a>
                </li>

                <li>
                    <a href="mailto:{{ $settings->email ?? 'info@foodly.ch' }}"
                        class="text-gray-600 hover:text-primary">
                        {{ $settings->email ?? 'info@foodly.ch' }}
                    </a>
                </li>

                <li>
                    <a href="#" class="text-gray-600 hover:text-primary">
                        {{ $settings->address }}
                    </a>
                </li>
            </ul>
        </div>

        <!-- Opening Hours -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Opening Hours</h3>

            <ul class="space-y-1 text-gray-600 text-sm">
                @foreach ($openingHours as $day)
                    <li>
                        <strong>{{ $day['day'] }}:</strong>

                        @if ($day['closed'])
                            Closed
                        @else
                            @foreach ($day['shifts'] as $shift)
                                {{ $shift['open'] }} – {{ $shift['close'] }}
                                @if (!$loop->last)
                                    /
                                @endif
                            @endforeach
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Extra Column (Optional) -->
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $settings->siteName }}</h3>
            <p class="text-gray-600 text-sm">
                {{ $settings->description }}
            </p>
        </div>

    </div>

    <!-- Bottom Footer -->
    <div
        class="mt-8 border-t border-gray-200 pt-4 flex flex-col md:flex-row justify-between items-center max-w-6xl mx-auto px-4">

        <p class="text-gray-600">© 2025 {{ $settings->siteName }}. All rights reserved.</p>

        <div class="flex space-x-4">
            <a href="#" class="text-gray-600 hover:text-primary">Privacy Policy</a>
            <a href="#" class="text-gray-600 hover:text-primary">Terms of Service</a>
            <a href="#" class="text-gray-600 hover:text-primary">Cookie Policy</a>
        </div>

    </div>

</footer>
