<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Manajemen Perkuliahan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <style>
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .sidebar-link {
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: white;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar-link:hover::before,
        .sidebar-link.active::before {
            transform: scaleY(1);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-inter">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-72 bg-gradient-to-br from-emerald-600 via-emerald-700 to-sky-600 text-white flex flex-col shadow-2xl" style="animation: slideIn 0.5s ease-out;">
            
            {{-- Logo Section --}}
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-graduation-cap text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Akademik</h2>
                        <p class="text-xs text-white/70">Sistem Manajemen</p>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link    flex items-center px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-home text-sm"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.user') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <span class="font-medium">Users</span>
                    <!-- <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">12</span> -->
                </a>
                
                <a href="{{ route('admin.fakultas') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-book text-sm"></i>
                    </div>
                    <span class="font-medium">Fakultas</span>
                </a>
                
                <a href="{{ route('admin.jurusan') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-clipboard-list text-sm"></i>
                    </div>
                    <span class="font-medium">Jurusan</span>
                </a>

                <div class="pt-4 mt-4 border-t border-white/20">
                    
                    <a href="{{ route('admin.role') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                        <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                            <i class="fas fa-chart-bar text-sm"></i>
                        </div>
                        <span class="font-medium">Roles</span>
                    </a>
                </div>
            </nav>

            {{-- User Profile & Logout --}}
            <div class="p-4 border-t border-white/20">
                <div class="bg-white/10 rounded-xl p-4 mb-3 backdrop-blur-sm">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-emerald-400 to-sky-400 p-2 rounded-lg">
                            <i class="fas fa-user text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm truncate">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-white/70 truncate">{{ Auth::user()->email ?? 'user@email.com' }}</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 rounded-xl bg-red-500/90 hover:bg-red-600 transition-all duration-300 font-medium group">
                        <i class="fas fa-sign-out-alt mr-2 group-hover:translate-x-1 transition-transform"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Navbar --}}
            <header class="glass-effect shadow-lg px-8 py-5 flex items-center justify-between sticky top-0 z-10" style="animation: fadeIn 0.5s ease-out;">
                <div>
                    <h1 class="text-2xl font-bold gradient-text">{{ $title ?? 'Dashboard' }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! 👋</p>
                </div>
                
                <div class="flex items-center space-x-4">
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-8 overflow-y-auto">
                <div style="animation: fadeIn 0.7s ease-out;">
                    {{-- Original Slot Content --}}
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <footer class="bg-white border-t border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <p>&copy; 2025 Sistem Akademik. All rights reserved.</p>
                </div>
            </footer>

        </div>
    </div>

</body>
</html>