<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - Manajemen Perkuliahan</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
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
                <a href="{{ route('dashboard') }}" class="sidebar-link active flex items-center px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-home text-sm"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <span class="font-medium">Mahasiswa</span>
                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">12</span>
                </a>
                
                <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-book text-sm"></i>
                    </div>
                    <span class="font-medium">Mata Kuliah</span>
                </a>
                
                <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                    <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                        <i class="fas fa-clipboard-list text-sm"></i>
                    </div>
                    <span class="font-medium">Jadwal</span>
                </a>

                <div class="pt-4 mt-4 border-t border-white/20">
                    <p class="text-xs text-white/50 px-4 mb-2 uppercase tracking-wider">Lainnya</p>
                    
                    <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                        <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                            <i class="fas fa-chart-bar text-sm"></i>
                        </div>
                        <span class="font-medium">Laporan</span>
                    </a>
                    
                    <a href="#" class="sidebar-link flex items-center px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-300 group">
                        <div class="bg-white/0 group-hover:bg-white/20 p-2 rounded-lg mr-3 group-hover:scale-110 transition-all">
                            <i class="fas fa-cog text-sm"></i>
                        </div>
                        <span class="font-medium">Pengaturan</span>
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

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Navbar --}}
            <header class="glass-effect shadow-lg px-8 py-5 flex items-center justify-between sticky top-0 z-10" style="animation: fadeIn 0.5s ease-out;">
                <div>
                    <h1 class="text-2xl font-bold gradient-text">{{ $title ?? 'Dashboard' }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! 👋</p>
                </div>
                
                <div class="flex items-center space-x-4">
                    {{-- Search Bar --}}
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Cari..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all w-64">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    {{-- Notifications --}}
                    <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    {{-- Profile Badge --}}
                    <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-sky-500 flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-8 overflow-y-auto">
                <div style="animation: fadeIn 0.7s ease-out;">
                    
                    {{-- Quick Stats Cards --}}
                    @if(Route::currentRouteName() === 'dashboard')
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        {{-- Total Mahasiswa --}}
                        <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-xl">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                                <span class="text-green-500 text-sm font-semibold flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 12%
                                </span>
                            </div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Total Mahasiswa</h3>
                            <p class="text-3xl font-bold text-gray-800">1,234</p>
                            <p class="text-xs text-gray-400 mt-2">+180 bulan ini</p>
                        </div>

                        {{-- Mata Kuliah Aktif --}}
                        <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-3 rounded-xl">
                                    <i class="fas fa-book text-white text-2xl"></i>
                                </div>
                                <span class="text-green-500 text-sm font-semibold flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 8%
                                </span>
                            </div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Mata Kuliah</h3>
                            <p class="text-3xl font-bold text-gray-800">48</p>
                            <p class="text-xs text-gray-400 mt-2">Semester ini</p>
                        </div>

                        {{-- Dosen Aktif --}}
                        <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-3 rounded-xl">
                                    <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                                </div>
                                <span class="text-green-500 text-sm font-semibold flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i> 5%
                                </span>
                            </div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Dosen Aktif</h3>
                            <p class="text-3xl font-bold text-gray-800">87</p>
                            <p class="text-xs text-gray-400 mt-2">Tenaga pengajar</p>
                        </div>

                        {{-- Kelas Berlangsung --}}
                        <div class="card-hover bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-3 rounded-xl">
                                    <i class="fas fa-calendar-check text-white text-2xl"></i>
                                </div>
                                <span class="text-blue-500 text-sm font-semibold flex items-center">
                                    <i class="fas fa-circle mr-1 text-xs animate-pulse"></i> Live
                                </span>
                            </div>
                            <h3 class="text-gray-500 text-sm font-medium mb-1">Kelas Berlangsung</h3>
                            <p class="text-3xl font-bold text-gray-800">12</p>
                            <p class="text-xs text-gray-400 mt-2">Hari ini</p>
                        </div>
                    </div>

                    {{-- Quick Actions & Recent Activity --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        {{-- Quick Actions --}}
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                                Aksi Cepat
                            </h3>
                            <div class="space-y-3">
                                <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-emerald-50 to-emerald-100 hover:from-emerald-100 hover:to-emerald-200 transition-all group">
                                    <span class="flex items-center text-emerald-700 font-medium">
                                        <i class="fas fa-user-plus mr-3"></i>
                                        Tambah Mahasiswa
                                    </span>
                                    <i class="fas fa-chevron-right text-emerald-600 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                                
                                <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 transition-all group">
                                    <span class="flex items-center text-blue-700 font-medium">
                                        <i class="fas fa-book-medical mr-3"></i>
                                        Buat Mata Kuliah
                                    </span>
                                    <i class="fas fa-chevron-right text-blue-600 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                                
                                <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 transition-all group">
                                    <span class="flex items-center text-purple-700 font-medium">
                                        <i class="fas fa-calendar-plus mr-3"></i>
                                        Atur Jadwal
                                    </span>
                                    <i class="fas fa-chevron-right text-purple-600 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                                
                                <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gradient-to-r from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 transition-all group">
                                    <span class="flex items-center text-orange-700 font-medium">
                                        <i class="fas fa-file-export mr-3"></i>
                                        Export Data
                                    </span>
                                    <i class="fas fa-chevron-right text-orange-600 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Recent Activity --}}
                        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-between">
                                <span class="flex items-center">
                                    <i class="fas fa-history text-blue-500 mr-2"></i>
                                    Aktivitas Terbaru
                                </span>
                                <a href="#" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua</a>
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="bg-blue-100 p-2 rounded-lg">
                                        <i class="fas fa-user-plus text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800">Mahasiswa baru terdaftar</p>
                                        <p class="text-xs text-gray-500">Andi Pratama - 2024010123</p>
                                        <p class="text-xs text-gray-400 mt-1">5 menit yang lalu</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="bg-green-100 p-2 rounded-lg">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800">Jadwal kuliah disetujui</p>
                                        <p class="text-xs text-gray-500">Algoritma & Pemrograman - Senin 08:00</p>
                                        <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="bg-purple-100 p-2 rounded-lg">
                                        <i class="fas fa-book text-purple-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800">Mata kuliah baru ditambahkan</p>
                                        <p class="text-xs text-gray-500">Basis Data Lanjut - 3 SKS</p>
                                        <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                    <div class="bg-orange-100 p-2 rounded-lg">
                                        <i class="fas fa-edit text-orange-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-800">Data mahasiswa diupdate</p>
                                        <p class="text-xs text-gray-500">Siti Nurhaliza - Perubahan alamat</p>
                                        <p class="text-xs text-gray-400 mt-1">3 jam yang lalu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Schedule & Announcement --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        {{-- Today's Schedule --}}
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-clock text-emerald-500 mr-2"></i>
                                Jadwal Hari Ini
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">Algoritma & Pemrograman</p>
                                        <p class="text-sm text-gray-600">Ruang 301 - Dr. Ahmad Dahlan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-blue-600">08:00</p>
                                        <p class="text-xs text-gray-500">2 jam</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-emerald-50 to-emerald-100 border-l-4 border-emerald-500">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">Basis Data</p>
                                        <p class="text-sm text-gray-600">Ruang Lab 2 - Prof. Siti Aminah</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-emerald-600">10:00</p>
                                        <p class="text-xs text-gray-500">3 jam</p>
                                    </div>
                                </div>

                                <div class="flex items-center p-4 rounded-xl bg-gradient-to-r from-purple-50 to-purple-100 border-l-4 border-purple-500">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">Pemrograman Web</p>
                                        <p class="text-sm text-gray-600">Ruang 205 - Ir. Budi Santoso</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-purple-600">13:00</p>
                                        <p class="text-xs text-gray-500">2 jam</p>
                                    </div>
                                </div>
                            </div>
                            <button class="w-full mt-4 py-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors font-medium">
                                Lihat Jadwal Lengkap
                            </button>
                        </div>

                        {{-- Announcements --}}
                        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-bullhorn text-orange-500 mr-2"></i>
                                Pengumuman
                            </h3>
                            <div class="space-y-4">
                                <div class="p-4 rounded-xl bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="bg-red-500 text-white text-xs px-3 py-1 rounded-full font-semibold">PENTING</span>
                                        <span class="text-xs text-gray-500">1 hari lalu</span>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Ujian Tengah Semester</h4>
                                    <p class="text-sm text-gray-600">UTS akan dilaksanakan tanggal 15-20 November 2025. Harap mahasiswa mempersiapkan diri.</p>
                                </div>

                                <div class="p-4 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold">INFO</span>
                                        <span class="text-xs text-gray-500">2 hari lalu</span>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Libur Nasional</h4>
                                    <p class="text-sm text-gray-600">Kampus libur pada tanggal 28 Oktober 2025 dalam rangka Hari Sumpah Pemuda.</p>
                                </div>

                                <div class="p-4 rounded-xl bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500">
                                    <div class="flex items-start justify-between mb-2">
                                        <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold">EVENT</span>
                                        <span class="text-xs text-gray-500">3 hari lalu</span>
                                    </div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Seminar Teknologi</h4>
                                    <p class="text-sm text-gray-600">Seminar "AI dalam Pendidikan" akan diadakan pada 30 Oktober 2025 di Auditorium.</p>
                                </div>
                            </div>
                            <button class="w-full mt-4 py-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors font-medium">
                                Lihat Semua Pengumuman
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Original Slot Content --}}
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <footer class="bg-white border-t border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <p>&copy; 2025 Sistem Akademik. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-emerald-600 transition-colors">Bantuan</a>
                        <a href="#" class="hover:text-emerald-600 transition-colors">Privacy</a>
                        <a href="#" class="hover:text-emerald-600 transition-colors">Terms</a>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>
</html>