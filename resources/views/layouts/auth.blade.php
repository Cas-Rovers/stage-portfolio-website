<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/assets/frontend/css/app.css'])
</head>

<body class="min-h-screen antialiased">
    <main class="container mx-auto">
        @yield('content')
    </main>
    @vite(['resources/assets/frontend/js/app.js'])
    @stack('scripts')
</body>

</html>
