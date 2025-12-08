<x-guest-layout>
    <div>
        <div>
            <h2 class="text-2xl font-bold text-center text-amber-800 mb-6">Login Pencatatan Kendaraan Dinas</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-amber-800">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="block w-full mt-1 border border-amber-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-400">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-amber-800">Password</label>
                    <input id="password" type="password" name="password" required
                        class="block w-full mt-1 border border-amber-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-400">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="remember" id="remember" class="text-amber-600 focus:ring-amber-500">
                    <label for="remember" class="ml-2 text-sm text-amber-700">Ingat Saya</label>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg transition-all">
                        Login
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('register') }}" class="text-sm text-amber-700 hover:underline">
                        Belum punya akun? Daftar di sini
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
