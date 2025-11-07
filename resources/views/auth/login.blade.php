<x-layouts.auth title="Login">
    <div class="bg-white rounded-2xl shadow-xl w-full p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login ke Akun Anda</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-emerald-500">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input id="email" type="email" name="email" required autofocus
                           class="pl-3 pr-4 py-2 w-full border border-sky-200 rounded-lg shadow-sm 
                                  focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 sm:text-sm">
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-sky-500">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="password" type="password" name="password" required
                           class="pl-3 pr-4 py-2 w-full border border-sky-200 rounded-lg shadow-sm 
                                  focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 sm:text-sm">
                </div>
            </div>

            {{-- Button Login --}}
            <div>
                <button type="submit"
                    class="w-full inline-flex items-center justify-center px-4 py-2 
                           bg-gradient-to-r from-emerald-500 to-sky-500 
                           text-white font-semibold rounded-lg shadow-md 
                           hover:from-emerald-600 hover:to-sky-600 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-400 
                           transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </button>
            </div>

            {{-- Divider --}}
            <div class="flex items-center my-6">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="px-4 text-sm text-gray-500">atau</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            {{-- Register Link --}}
            <p class="text-sm text-center text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-sky-600 hover:text-sky-700">Daftar sekarang</a>
            </p>
        </form>
    </div>
</x-layouts.auth>
