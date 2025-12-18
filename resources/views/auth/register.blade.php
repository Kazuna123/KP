<x-guest-layout>
    <div>
        <div>
            <h2 class="text-3xl font-bold text-amber-800 mb-2">Buat Akun Baru</h2>
            <p class="text-amber-700 mb-8 text-sm">Daftar untuk mengakses sistem peminjaman kendaraan dinas</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="mb-4 text-left">
                    <label class="block text-sm font-medium text-amber-800 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required autofocus
                        class="w-full border border-amber-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>
                <!-- Email -->
                <div class="mb-4 text-left">
                    <label class="block text-sm font-medium text-amber-800 mb-1">Email</label>
                    <input type="email" name="email" required
                        class="w-full border border-amber-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <!-- Password -->
                <div class="mb-4 text-left">
                    <label class="block text-sm font-medium text-amber-800 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-amber-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <!-- Konfirmasi -->
                <div class="mb-6 text-left">
                    <label class="block text-sm font-medium text-amber-800 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-amber-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg transition-all shadow-md">
                    Daftar Sekarang
                </button>

                <p class="mt-6 text-sm text-amber-800">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold hover:underline text-amber-700">
                        Masuk di sini
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
