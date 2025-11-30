@php
    $logo = site_settings('logo');

@endphp

<img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="w-48">
