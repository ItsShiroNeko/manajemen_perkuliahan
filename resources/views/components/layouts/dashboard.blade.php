<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Manajemen Perkuliahan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-inter">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gradient-to-b from-emerald-600 to-sky-600 text-white flex flex-col">
            <div class="p-4 text-2xl font-bold border-b border-emerald-500">
                <i class="fas fa-graduation-cap mr-2"></i> Akademik
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-emerald-500 transition">
                    <i class="fas fa-home w-5 mr-2"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-emerald-500 transition">
                    <i class="fas fa-users w-5 mr-2"></i> Mahasiswa
                </a>
                <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-emerald-500 transition">
                    <i class="fas fa-book w-5 mr-2"></i> Mata Kuliah
                </a>
                <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-emerald-500 transition">
                    <i class="fas fa-clipboard-list w-5 mr-2"></i> Jadwal
                </a>
            </nav>

            <div class="p-4 border-t border-emerald-500">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500 transition">
                        <i class="fas fa-sign-out-alt w-5 mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">

            {{-- Navbar --}}
            <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-700">{{ $title ?? 'Dashboard' }}</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">
                        <i class="fas fa-user-circle mr-1"></i>
                        {{ Auth::user()->name ?? 'User' }}
                    </span>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>
    </div>

</body>
</html>
