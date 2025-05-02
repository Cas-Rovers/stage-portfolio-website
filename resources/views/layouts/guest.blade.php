<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="font-geist scroll-smooth" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/assets/frontend/css/app.css'])
    @livewireStyles()
</head>

<body
    class="dark:bg-midnight-700 text-grey-800 min-h-screen w-full bg-white antialiased md:subpixel-antialiased dark:text-white">
    @include('components.frontend.navbar')
    <main>
        @yield('content')
    </main>
    @include('components.frontend.footer')
    @vite(['resources/assets/frontend/js/app.js'])
    @livewireScriptConfig()
    @stack('scripts')
</body>

</html>
