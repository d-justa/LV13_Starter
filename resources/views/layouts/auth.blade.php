<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance
</head>

<body class="min-h-screen flex flex-col bg-gray-100 ">

    <header>
        {{-- Header --}}
    </header>

    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>

    <footer class="p-2">
        <flux:text class="text-center">Powered by <flux:link href="#">Netgen IT Solutions</flux:link></flux:text>
    </footer>

    @fluxScripts
</body>

</html>
