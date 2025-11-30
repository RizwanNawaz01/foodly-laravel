@props(['type' => 'success', 'message' => null])


@if (session('message') || $message)
    @php
        $flashType = session('type') ?? $type;
        $flashMessage = session('message') ?? $message;
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">
        {{ $flashMessage }}
    </div>
@endif


@if (session('success'))
    @php
        $flashType = session('type') ?? $type;
        $flashMessage = session('message') ?? $message;
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">
        {{ $flashMessage }}
    </div>
@endif

@if (session('error'))
    @php
        $flashType = session('type') ?? $type;
        $flashMessage = session('message') ?? $message;
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">
        {{ $flashMessage }}
    </div>
@endif

@if (session('warning'))
    @php
        $flashType = session('type') ?? $type;
        $flashMessage = session('message') ?? $message;
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">
        {{ $flashMessage }}
    </div>
@endif

@if (session('info'))
    @php
        $flashType = session('type') ?? $type;
        $flashMessage = session('message') ?? $message;
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">
        {{ $flashMessage }}
    </div>
@endif
{{-- Validation Errors --}}
@if ($errors->any())
    @php
        $flashType = 'error';
        $flashMessage = $errors->all();
        $bgColor = match ($flashType) {
            'success' => 'bg-green-500',
            'error' => 'bg-red-500',
            'warning' => 'bg-yellow-400',
            default => 'bg-blue-500',
        };
    @endphp

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-5 right-5 z-50 p-4 rounded shadow text-white {{ $bgColor }} transition-all duration-300">

        <strong>Validation Error</strong>
        <ul class="mt-2 list-disc ml-4">
            @foreach ($flashMessage as $msg)
                <li>{{ $msg }}</li>
            @endforeach
        </ul>

    </div>
@endif
