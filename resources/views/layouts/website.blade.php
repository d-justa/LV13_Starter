<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <header>
        Header
    </header>

    <main class="flex-1 flex flex-col">
        {{ $slot }}
    </main>

    <footer class="bg-slate-900 text-white p-4">
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 text-sm">
            <p class="text-center">Copyright &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p class="text-center">Made with ❤️ by <a href="#" target="_blank" class="text-blue-500 hover:underline">Netgen IT Solutions</a></p>
        </div>
    </footer>

    @fluxScripts
</body>

</html>
