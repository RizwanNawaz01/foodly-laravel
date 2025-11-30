<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ site_settings('siteName', 'Foodly') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('storage/' . site_settings('favicon', '/favicon.ico')) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <meta name="title" content="{{ site_settings('metaTitle', 'Foodly') }}">
    <meta name="description" content="{{ site_settings('metaDescription', 'Foodly') }}">

    <script src="
                https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/intlTelInput.min.js
                "></script>
    <link href="
https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/css/intlTelInput.min.css
" rel="stylesheet">

    @yield('meta')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col pt-20">
    <!-- Page Heading -->
    <livewire:layout.header />
    <livewire:search-modal />
    <livewire:delivery-selector />
    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>
    <livewire:layout.footer />
    @livewire('cart')
    <x-flash-message />


</body>

</html>
