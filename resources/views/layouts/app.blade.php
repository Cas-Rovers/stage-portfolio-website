<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=yes, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @livewireStyles
    @vite(['resources/assets/admin/css/app.css'])
</head>

<body class="flex min-h-screen antialiased">

    <body class="flex min-h-screen bg-gray-100 antialiased dark:bg-gray-900">
        <div class="flex flex-1">
            <x-admin.sidebar />
            <div class="flex-1">
                <x-admin.top-nav />
                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
        @livewireScriptConfig
        @vite(['resources/assets/admin/js/app.js'])
        @stack('scripts')
    </body>

</html>
