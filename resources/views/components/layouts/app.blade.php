<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ secure_asset('img/logo.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="h-full flex flex-col">
    <div class="flex flex-col min-h-screen w-full">
        @include('components.layouts.header')

        <main class="flex-1">
            {{ $slot }}
        </main>

        @include('components.layouts.footer')
    </div>

    @livewireScripts

    {{-- Script untuk debugging di development --}}
    @if (config('app.debug'))
        <script>
            // Debug helper untuk development
            window.addEventListener('DOMContentLoaded', function() {
                console.log('DOM loaded - Laravel:', '{{ app()->version() }}');
                console.log('Environment:', '{{ app()->environment() }}');
                console.log('Livewire available:', typeof Livewire !== 'undefined');

                // Check if Chart.js loaded
                setTimeout(() => {
                    console.log('Chart.js available:', typeof Chart !== 'undefined');
                    if (typeof Chart !== 'undefined') {
                        console.log('Chart.js version:', Chart.version);
                    }
                }, 1000);
            });
        </script>
    @endif
</body>

</html>
