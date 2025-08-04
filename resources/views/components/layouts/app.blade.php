<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    @if (app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app-xxxx.css') }}">
        <script type="module" src="{{ asset('build/assets/app-xxxx.js') }}"></script>
    @endif

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
</body>
<script>
    document.addEventListener('livewire:navigated', () => {
        if (typeof renderChartsAsync === 'function') {
            destroyAllCharts();
            renderChartsAsync();
        }
    });
</script>

</html>
