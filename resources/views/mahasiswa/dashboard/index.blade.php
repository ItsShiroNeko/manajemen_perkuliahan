<x-layouts.mahasiswa title="Dashboard Mahasiswa">
@php
        // ===== Dummy Data =====
        $mahasiswa = (object)[
            'nama_lengkap' => 'Shiro Neko',
            'nim' => '220102001',
            'semester_saat_ini' => 5,
            'jurusan' => (object)['nama_jurusan' => 'Teknik Informatika'],
            'angkatan' => 2022,
            'ipk' => 3.72,
            'total_sks' => 104,
            'status' => 'Aktif'
        ];

        $progress_percentage = ($mahasiswa->total_sks / 144) * 100;
        $hari_ini = 'Jumat, 24 Oktober 2025';
        $sisa_sks = 144 - $mahasiswa->total_sks;
        $ip_semester_terakhir = 3.85;

        $jadwal_hari_ini = [
            (object)[
                'kelas' => (object)[
                    'mataKuliah' => (object)['nama_mk' => 'Pemrograman Web Lanjut', 'sks' => 3],
                    'dosen' => (object)['nama_dosen' => 'Dr. Andika Putra, M.Kom'],
                    'nama_kelas' => 'TI-5A'
                ],
                'ruangan' => (object)['nama_ruangan' => 'Lab Komputer 2'],
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00'
            ],
            (object)[
                'kelas' => (object)[
                    'mataKuliah' => (object)['nama_mk' => 'Sistem Cerdas', 'sks' => 2],
                    'dosen' => (object)['nama_dosen' => 'Sinta Rahmawati, M.T'],
                    'nama_kelas' => 'TI-5A'
                ],
                'ruangan' => (object)['nama_ruangan' => 'Ruang D204'],
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:00'
            ]
        ];

        $krs_aktif_count = count($jadwal_hari_ini);

        $pengumuman = [
            (object)[
                'kategori' => 'Akademik',
                'tanggal' => '22 Oktober 2025',
                'judul' => 'Batas Akhir Pengisian KRS Semester Genap',
                'isi' => 'Mahasiswa diharapkan segera menyelesaikan pengisian KRS maksimal tanggal 27 Oktober 2025.'
            ],
            (object)[
                'kategori' => 'Umum',
                'tanggal' => '20 Oktober 2025',
                'judul' => 'Libur Nasional Maulid Nabi',
                'isi' => 'Kegiatan perkuliahan akan diliburkan pada tanggal 25 Oktober 2025 dalam rangka memperingati Maulid Nabi Muhammad SAW.'
            ]
        ];

        $krs_semester_ini = [
            (object)[
                'mataKuliah' => (object)['kode_mk' => 'IF501', 'nama_mk' => 'Pemrograman Web Lanjut', 'sks' => 3, 'jenis' => 'Wajib'],
                'kelas' => (object)['nama_kelas' => 'TI-5A', 'dosen' => (object)['nama_dosen' => 'Dr. Andika Putra, M.Kom']],
                'nilai' => (object)['nilai_huruf' => 'A']
            ],
            (object)[
                'mataKuliah' => (object)['kode_mk' => 'IF502', 'nama_mk' => 'Kecerdasan Buatan', 'sks' => 2, 'jenis' => 'Wajib'],
                'kelas' => (object)['nama_kelas' => 'TI-5A', 'dosen' => (object)['nama_dosen' => 'Sinta Rahmawati, M.T']],
                'nilai' => (object)['nilai_huruf' => 'B']
            ],
            (object)[
                'mataKuliah' => (object)['kode_mk' => 'IF503', 'nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'jenis' => 'Wajib'],
                'kelas' => (object)['nama_kelas' => 'TI-5A', 'dosen' => (object)['nama_dosen' => 'Budi Santoso, M.Kom']],
                'nilai' => (object)['nilai_huruf' => 'A']
            ],
        ];
    @endphp
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-emerald-500 via-emerald-600 to-sky-600 rounded-2xl p-8 mb-6 shadow-xl text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ $mahasiswa->nama_lengkap }}! 👋</h2>
                <p class="text-emerald-50 text-lg">NIM: {{ $mahasiswa->nim }} | Semester {{ $mahasiswa->semester_saat_ini }}</p>
                <div class="flex items-center space-x-6 mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-graduation-cap"></i>
                        <span>{{ $mahasiswa->jurusan->nama_jurusan }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar"></i>
                        <span>Angkatan {{ $mahasiswa->angkatan }}</span>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 text-center">
                    <p class="text-sm text-emerald-50 mb-1">IPK Anda</p>
                    <p class="text-5xl font-bold">{{ number_format($mahasiswa->ipk, 2) }}</p>
                    <div class="mt-2 flex items-center justify-center">
                        @if($mahasiswa->ipk >= 3.5)
                            <span class="bg-yellow-400 text-yellow-900 text-xs px-3 py-1 rounded-full font-semibold">Cumlaude</span>
                        @elseif($mahasiswa->ipk >= 3.0)
                            <span class="bg-green-400 text-green-900 text-xs px-3 py-1 rounded-full font-semibold">Sangat Baik</span>
                        @else
                            <span class="bg-blue-400 text-blue-900 text-xs px-3 py-1 rounded-full font-semibold">Baik</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Total SKS --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 p-3 rounded-xl">
                    <i class="fas fa-book-open text-blue-600 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Total SKS</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $mahasiswa->total_sks }}</p>
            <p class="text-xs text-gray-400 mt-2">dari 144 SKS</p>
            <div class="mt-3 bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress_percentage }}%"></div>
            </div>
        </div>

        {{-- Semester Saat Ini --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-emerald-100 p-3 rounded-xl">
                    <i class="fas fa-layer-group text-emerald-600 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Semester Aktif</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $mahasiswa->semester_saat_ini }}</p>
            <p class="text-xs text-gray-400 mt-2">Semester saat ini</p>
        </div>

        {{-- Mata Kuliah Aktif --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-purple-100 p-3 rounded-xl">
                    <i class="fas fa-clipboard-list text-purple-600 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Mata Kuliah</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $krs_aktif_count ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-2">Semester ini</p>
        </div>

        {{-- Status Akademik --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-orange-100 p-3 rounded-xl">
                    <i class="fas fa-user-check text-orange-600 text-2xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium mb-1">Status</h3>
            <p class="text-2xl font-bold text-gray-800">{{ $mahasiswa->status }}</p>
            @if($mahasiswa->status === 'Aktif')
                <span class="inline-block mt-2 bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                    <i class="fas fa-check-circle mr-1"></i>Aktif
                </span>
            @else
                <span class="inline-block mt-2 bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded-full">
                    {{ $mahasiswa->status }}
                </span>
            @endif
        </div>
    </div>
    {{-- Mata Kuliah Semester Ini --}}
    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-between">
            <span class="flex items-center">
                <i class="fas fa-book text-emerald-500 mr-2"></i>
                Mata Kuliah Semester Ini
            </span>
            <a href="" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                Lihat Detail KRS <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </h3>

        @if(isset($krs_semester_ini) && count($krs_semester_ini) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kode MK</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Mata Kuliah</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">SKS</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Dosen</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kelas</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($krs_semester_ini as $krsDetail)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-mono text-gray-600">
                                {{ $krsDetail->mataKuliah->kode_mk }}
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $krsDetail->mataKuliah->nama_mk }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $krsDetail->mataKuliah->jenis ?? 'Wajib' }}
                                </p>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full font-semibold">
                                    {{ $krsDetail->mataKuliah->sks }} SKS
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $krsDetail->kelas->dosen->nama_dosen ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $krsDetail->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if(isset($krsDetail->nilai) && $krsDetail->nilai)
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                                        @if($krsDetail->nilai->nilai_huruf === 'A') bg-green-100 text-green-700
                                        @elseif($krsDetail->nilai->nilai_huruf === 'B') bg-blue-100 text-blue-700
                                        @elseif($krsDetail->nilai->nilai_huruf === 'C') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ $krsDetail->nilai->nilai_huruf }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">Belum ada</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-inbox text-gray-300 text-5xl mb-3"></i>
                <p class="text-gray-500">Belum ada mata kuliah yang diambil semester ini</p>
                <a href="" class="inline-block mt-4 px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                    Isi KRS Sekarang
                </a>
            </div>
        @endif
    </div>

</x-layouts.dashboard>