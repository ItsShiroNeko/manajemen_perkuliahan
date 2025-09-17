<x-layouts.auth>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-200 via-blue-100 to-green-100">
        <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Lupa Password</h2>
            <p class="text-center text-sm text-gray-600 mb-4">
                Masukkan email Anda, kami akan mengirimkan link untuk reset password.
            </p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <x-button type="submit" color="primary" size="md" class="w-full">
                    Kirim Link Reset
                </x-button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Kembali ke Login</a>
            </p>
        </div>
    </div>
</x-layouts.auth>
