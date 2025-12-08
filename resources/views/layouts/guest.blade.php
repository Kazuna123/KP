<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistem Pencatatan Kendaraan Dinas | Dinas PU Bina Marga Jatim</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-amber-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo dan Judul -->
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Bina Marga" class="w-24 h-24 mb-3">
                <h2 class="text-xl font-semibold text-gray-800 text-center">
                    Dinas PU Bina Marga Jawa Timur
                </h2>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Sistem Pencatatan Kendaraan Dinas
                </p>
            </div>

            <!-- Card -->
            <div class="w-full sm:max-w-md mt-2 px-6 py-6 bg-white shadow-lg overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
