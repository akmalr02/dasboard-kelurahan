<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ secure_asset('img/logo.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('build/assets/app-BSZC8mRm.css') }}">
    <script src="{{ secure_asset('build/assets/app-CLIHQhyv.js') }}" defer></script>
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

</html>
