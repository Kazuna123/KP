<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Kendaraan Dinas</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-amber-50 to-white font-sans">
    <div class="relative min-h-screen flex flex-col items-center justify-center text-center">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center brightness-75"
             style="background-image: url('{{ asset('images/gedung.png') }}');">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-amber-50/40 to-white/80"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-3xl p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-lg border border-amber-200">
            <h1 class="text-4xl font-bold text-amber-800 mb-4 drop-shadow-lg">
                Sistem Peminjaman Kendaraan Dinas
            </h1>
            <p class="text-lg text-amber-700 mb-8">
                Dinas PU Bina Marga Jawa Timur — Mewujudkan Efisiensi dan Transparansi Pengelolaan Kendaraan Dinas
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white rounded-lg font-semibold transition-all shadow-md">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 bg-white border-2 border-amber-600 text-amber-800 hover:bg-amber-100 rounded-lg font-semibold transition-all shadow-md">
                    Register
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="absolute bottom-4 text-amber-900 text-sm">
            &copy; {{ date('Y') }} Dinas PU Bina Marga Jatim. All rights reserved.
        </footer>
    </div>
</body>
</html>
