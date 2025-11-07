<x-layouts.mahasiswa>
    <x-slot:title>Kartu Rencana Studi (KRS)</x-slot:title>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-home mr-2"></i>
            <a href="" class="hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <span class="text-emerald-600 font-medium">Kartu Rencana Studi</span>
        </div>
    </div>

    <!-- Status Banner -->
    @php
        $krsAktif = $krsAktif ?? null;
        $statusKrs = $krsAktif->status ?? 'Belum Diisi';
        $isPeriodeKrs = $isPeriodeKrs ?? true;
    @endphp

    @if($isPeriodeKrs)
        @if($statusKrs == 'Draft' || $statusKrs == 'Belum Diisi')
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 p-4 rounded-lg mb-6 card-hover">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="bg-amber-500 text-white p-2 rounded-lg">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Periode Pengisian KRS Aktif!</h3>
                    <p class="text-sm text-gray-700">Silakan lengkapi KRS Anda dan ajukan untuk persetujuan Dosen PA. Batas pengisian: <strong>{{ $batasPengisian ?? '31 Desember 2024' }}</strong></p>
                </div>
            </div>
        </div>
        @elseif($statusKrs == 'Diajukan')
        <div class="bg-gradient-to-r from-blue-50 to-sky-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6 card-hover">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="bg-blue-500 text-white p-2 rounded-lg pulse">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">KRS Menunggu Persetujuan</h3>
                    <p class="text-sm text-gray-700">KRS Anda telah diajukan dan sedang menunggu persetujuan dari Dosen PA: <strong>{{ $krsAktif->dosenPa->nama ?? '-' }}</strong></p>
                </div>
            </div>
        </div>
        @elseif($statusKrs == 'Disetujui')
        <div class="bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 p-4 rounded-lg mb-6 card-hover">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="bg-emerald-500 text-white p-2 rounded-lg">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">KRS Telah Disetujui</h3>
                    <p class="text-sm text-gray-700">KRS Anda telah disetujui pada <strong>{{ $krsAktif->tanggal_persetujuan ?? '-' }}</strong>. Anda dapat mengikuti perkuliahan sesuai jadwal.</p>
                </div>
            </div>
        </div>
        @elseif($statusKrs == 'Ditolak')
        <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 p-4 rounded-lg mb-6 card-hover">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="bg-red-500 text-white p-2 rounded-lg">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-semibold text-gray-900 mb-1">KRS Ditolak</h3>
                    <p class="text-sm text-gray-700 mb-2">KRS Anda ditolak oleh Dosen PA. Silakan perbaiki dan ajukan kembali.</p>
                </div>
            </div>
        </div>
        @endif
    @else
    <div class="bg-gradient-to-r from-gray-50 to-slate-50 border-l-4 border-gray-500 p-4 rounded-lg mb-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="bg-gray-500 text-white p-2 rounded-lg">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Periode Pengisian KRS Ditutup</h3>
                <p class="text-sm text-gray-700">Pengisian KRS saat ini ditutup. Hubungi akademik untuk informasi lebih lanjut.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">SKS Diambil</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $krsAktif->total_sks ?? 0 }}</p>
                    <p class="text-xs text-gray-500 mt-1">dari max {{ $maxSks ?? 24 }} SKS</p>
                </div>
                <div class="bg-emerald-100 p-4 rounded-lg">
                    <i class="fas fa-graduation-cap text-emerald-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-sky-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Mata Kuliah</p>
                    <p class="text-3xl font-bold text-sky-600">{{ count($krsAktif->krsDetail ?? []) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Mata Kuliah</p>
                </div>
                <div class="bg-sky-100 p-4 rounded-lg">
                    <i class="fas fa-book text-sky-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status KRS</p>
                    <p class="text-xl font-bold text-purple-600">{{ $statusKrs }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $krsAktif->semester->nama_semester ?? 'Semester Aktif' }}</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    @if($statusKrs == 'Disetujui')
                        <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
                    @elseif($statusKrs == 'Diajukan')
                        <i class="fas fa-clock text-purple-600 text-2xl"></i>
                    @else
                        <i class="fas fa-edit text-purple-600 text-2xl"></i>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Dosen PA</p>
                    <p class="text-lg font-bold text-amber-600">{{ $krsAktif->dosenPa->nama ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $krsAktif->dosenPa->nip ?? '-' }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg">
                    <i class="fas fa-user-tie text-amber-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Available Courses -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 sticky top-6">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-sky-50">
                    <div class="flex items-center">
                        <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                            <i class="fas fa-list text-white"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Mata Kuliah Tersedia</h2>
                    </div>
                </div>

                <!-- Search -->
                <div class="p-4 border-b border-gray-200">
                    <div class="relative">
                        <input type="text" id="searchMataKuliah" placeholder="Cari mata kuliah..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Filter -->
                <div class="p-4 border-b border-gray-200">
                    <select id="filterJenis" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        <option value="">Semua Jenis</option>
                        <option value="Wajib">Mata Kuliah Wajib</option>
                        <option value="Pilihan">Mata Kuliah Pilihan</option>
                    </select>
                </div>

                <!-- Available Courses List -->
                <div class="p-4 max-h-96 overflow-y-auto" id="availableCourses">
                    @foreach($mataKuliahTersedia ?? [] as $mk)
                    <div class="mb-3 p-4 border border-gray-200 rounded-lg hover:border-emerald-500 hover:shadow-md transition-all cursor-pointer bg-white" 
                         draggable="true"
                         data-mk-id="{{ $mk->id }}"
                         data-mk-kode="{{ $mk->kode_mk }}"
                         data-mk-nama="{{ $mk->nama_mk }}"
                         data-mk-sks="{{ $mk->sks }}"
                         data-mk-jenis="{{ $mk->jenis }}"
                         onclick="addToKRS({{ $mk->id }})">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-0.5 rounded">{{ $mk->kode_mk }}</span>
                                    @if($mk->jenis == 'Wajib')
                                        <span class="ml-2 text-xs font-semibold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded">Wajib</span>
                                    @else
                                        <span class="ml-2 text-xs font-semibold text-amber-600 bg-amber-100 px-2 py-0.5 rounded">Pilihan</span>
                                    @endif
                                </div>
                                <h4 class="text-sm font-semibold text-gray-900 mb-1">{{ $mk->nama_mk }}</h4>
                                <div class="flex items-center text-xs text-gray-600">
                                    <i class="fas fa-credit-card mr-1 text-emerald-500"></i>
                                    <span>{{ $mk->sks }} SKS</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-layer-group mr-1 text-sky-500"></i>
                                    <span>Semester {{ $mk->semester_rekomendasi ?? '-' }}</span>
                                </div>
                            </div>
                            <button class="ml-2 text-emerald-600 hover:text-emerald-700">
                                <i class="fas fa-plus-circle text-xl"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column - Selected Courses (KRS) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-sky-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                                <i class="fas fa-clipboard-list text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-800">KRS Saya</h2>
                                <p class="text-xs text-gray-600">{{ $krsAktif->semester->nama_semester ?? 'Semester Aktif' }} - {{ $krsAktif->semester->tahun_akademik ?? '2024/2025' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-600">Total SKS</p>
                            <p class="text-2xl font-bold" id="totalSKS">
                                <span class="text-emerald-600">{{ $krsAktif->total_sks ?? 0 }}</span>
                                <span class="text-gray-400 text-sm">/ {{ $maxSks ?? 24 }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- KRS Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-1 text-emerald-500"></i> No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-book mr-1 text-emerald-500"></i> Mata Kuliah
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-credit-card mr-1 text-emerald-500"></i> SKS
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-users mr-1 text-emerald-500"></i> Kelas
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-clock mr-1 text-emerald-500"></i> Jadwal
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-chalkboard-teacher mr-1 text-emerald-500"></i> Dosen
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-cog mr-1 text-emerald-500"></i> Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="krsTableBody">
                            @forelse($krsAktif->krsDetail ?? [] as $index => $detail)
                            <tr class="hover:bg-emerald-50/50 transition-all" data-detail-id="{{ $detail->id }}">
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-700 font-semibold text-sm">
                                        {{ $index + 1 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $detail->kelas->mataKuliah->nama_mk ?? 'Mata Kuliah' }}</div>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                            <i class="fas fa-code text-gray-500 mr-1 text-xs"></i>
                                            {{ $detail->kelas->mataKuliah->kode_mk ?? 'MK001' }}
                                        </span>
                                        @if($detail->kelas->mataKuliah->jenis == 'Wajib')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-700">Wajib</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-700">Pilihan</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-sky-100 to-emerald-100 text-sky-800 border border-sky-200">
                                        {{ $detail->kelas->mataKuliah->sks ?? 3 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-purple-100 text-purple-800">
                                        {{ $detail->kelas->nama_kelas ?? 'A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $detail->kelas->hari ?? 'Senin' }}</div>
                                    <div class="text-xs text-gray-500">{{ $detail->kelas->jam_mulai ?? '08:00' }} - {{ $detail->kelas->jam_selesai ?? '10:00' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-sky-500 flex items-center justify-center text-white text-xs font-bold mr-2">
                                            {{ substr($detail->kelas->dosen->nama ?? 'D', 0, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ $detail->kelas->dosen->nama ?? 'Dosen' }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($statusKrs == 'Draft' || $statusKrs == 'Ditolak' || $statusKrs == 'Belum Diisi')
                                    <button onclick="removeFromKRS({{ $detail->id }})" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-300 text-sm font-medium shadow-sm">
                                        <i class="fas fa-trash mr-1"></i>
                                        Hapus
                                    </button>
                                    @else
                                    <span class="text-xs text-gray-500">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr id="emptyState">
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="bg-gray-100 p-6 rounded-full mb-4">
                                            <i class="fas fa-clipboard text-5xl text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Mata Kuliah</h3>
                                        <p class="text-gray-500">Silakan pilih mata kuliah dari daftar sebelah kiri</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Actions -->
                @if($statusKrs == 'Draft' || $statusKrs == 'Ditolak' || $statusKrs == 'Belum Diisi')
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            <span>Pastikan tidak ada jadwal yang bentrok sebelum mengajukan KRS</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="saveDraft()" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                                <i class="fas fa-save mr-2"></i>Simpan Draft
                            </button>
                            <button onclick="submitKRS()" class="bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-3 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>Ajukan KRS
                            </button>
                        </div>
                    </div>
                </div>
                @elseif($statusKrs == 'Diajukan')
                <div class="px-6 py-4 bg-blue-50 border-t border-blue-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-blue-800">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            <span>KRS Anda sedang menunggu persetujuan Dosen PA</span>
                        </div>
                        <button onclick="batalkanKRS()" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-all duration-300 font-medium">
                            <i class="fas fa-times mr-2"></i>Batalkan Pengajuan
                        </button>
                    </div>
                </div>
                @elseif($statusKrs == 'Disetujui')
                <div class="px-6 py-4 bg-emerald-50 border-t border-emerald-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-emerald-800">
                            <i class="fas fa-check-circle text-emerald-500 mr-2"></i>
                            <span>KRS Anda telah disetujui oleh {{ $krsAktif->dosenPa->nama ?? 'Dosen PA' }}</span>
                        </div>
                        <button onclick="printKRS()" class="bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-3 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md">
                            <i class="fas fa-print mr-2"></i>Cetak KRS
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Informasi Tambahan -->
            <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    Informasi Penting KRS
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Periode Pengisian
                        </h4>
                        <p class="text-sm text-blue-800">{{ $periodeKrs ?? '1 - 31 Desember 2024' }}</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-900 mb-2 flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Batas SKS
                        </h4>
                        <p class="text-sm text-green-800">
                            IPK ≥ 3.00: Max {{ $maxSks ?? 24 }} SKS<br>
                            IPK 2.50-2.99: Max 20 SKS<br>
                            IPK < 2.50: Max 18 SKS
                        </p>
                    </div>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-900 mb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Perhatian
                        </h4>
                        <ul class="text-sm text-purple-800 list-disc list-inside space-y-1">
                            <li>Cek jadwal agar tidak bentrok</li>
                            <li>Perhatikan prasyarat mata kuliah</li>
                            <li>Konsultasi dengan Dosen PA</li>
                        </ul>
                    </div>
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <h4 class="font-semibold text-amber-900 mb-2 flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            Kontak Bantuan
                        </h4>
                        <p class="text-sm text-amber-800">
                            Akademik: (0761) 12345<br>
                            Email: akademik@univ.ac.id<br>
                            WA: 0812-3456-7890
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm" onclick="closeModalOnOutside(event)">
        <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl rounded-2xl bg-white" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-3 rounded-xl mr-3">
                        <i class="fas fa-paper-plane text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Konfirmasi Pengajuan KRS</h3>
                </div>
                <button onclick="closeConfirmModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-all">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div id="confirmModalContent" class="mt-4">
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-amber-600 text-2xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-amber-900 mb-2">Perhatian!</h4>
                            <p class="text-sm text-amber-800">Setelah KRS diajukan, Anda tidak dapat mengubah mata kuliah hingga KRS disetujui atau ditolak oleh Dosen PA.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Ringkasan KRS:</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Mata Kuliah:</span>
                            <span class="font-semibold" id="totalMK">0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total SKS:</span>
                            <span class="font-semibold" id="confirmTotalSKS">0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dosen PA:</span>
                            <span class="font-semibold">{{ $krsAktif->dosenPa->nama ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button onclick="closeConfirmModal()" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button onclick="confirmSubmitKRS()" class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-3 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                        <i class="fas fa-check mr-2"></i>Ya, Ajukan KRS
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Mata Kuliah -->
    <div id="detailMKModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm" onclick="closeModalOnOutside(event)">
        <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-2/3 lg:w-1/2 shadow-2xl rounded-2xl bg-white" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-3 rounded-xl mr-3">
                        <i class="fas fa-book-open text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Detail Mata Kuliah</h3>
                </div>
                <button onclick="closeDetailMKModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-all">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div id="detailMKContent" class="mt-4">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    let currentTotalSKS = {{ $krsAktif->total_sks ?? 0 }};
    const maxSKS = {{ $maxSks ?? 24 }};
    let selectedCourses = [];

    // Search functionality
    document.getElementById('searchMataKuliah')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const courses = document.querySelectorAll('#availableCourses > div');
        
        courses.forEach(course => {
            const nama = course.dataset.mkNama?.toLowerCase() || '';
            const kode = course.dataset.mkKode?.toLowerCase() || '';
            
            if (nama.includes(searchTerm) || kode.includes(searchTerm)) {
                course.style.display = 'block';
            } else {
                course.style.display = 'none';
            }
        });
    });

    // Filter by type
    document.getElementById('filterJenis')?.addEventListener('change', function(e) {
        const jenis = e.target.value;
        const courses = document.querySelectorAll('#availableCourses > div');
        
        courses.forEach(course => {
            if (jenis === '' || course.dataset.mkJenis === jenis) {
                course.style.display = 'block';
            } else {
                course.style.display = 'none';
            }
        });
    });

    function addToKRS(mkId) {
        const course = document.querySelector(`[data-mk-id="${mkId}"]`);
        if (!course) return;

        const sks = parseInt(course.dataset.mkSks);
        
        // Check if adding this course exceeds max SKS
        if (currentTotalSKS + sks > maxSKS) {
            alert(`Tidak dapat menambahkan mata kuliah. Total SKS akan melebihi batas maksimal (${maxSKS} SKS)`);
            return;
        }

        // Check if course already added
        if (selectedCourses.includes(mkId)) {
            alert('Mata kuliah sudah ditambahkan ke KRS');
            return;
        }

        // Add to selected courses
        selectedCourses.push(mkId);
        currentTotalSKS += sks;
        
        // Update UI
        updateTotalSKS();
        
        // Add row to table (in real implementation, this would be an AJAX call)
        const tbody = document.getElementById('krsTableBody');
        const emptyState = document.getElementById('emptyState');
        if (emptyState) {
            emptyState.remove();
        }

        // Show success message
        showToast('Mata kuliah berhasil ditambahkan', 'success');

        // In real implementation, make AJAX call to save
        console.log('Adding course:', mkId);
    }

    function removeFromKRS(detailId) {
        if (!confirm('Yakin ingin menghapus mata kuliah ini dari KRS?')) {
            return;
        }

        // In real implementation, make AJAX call to delete
        const row = document.querySelector(`[data-detail-id="${detailId}"]`);
        if (row) {
            const sksElement = row.querySelector('td:nth-child(3) span');
            const sks = parseInt(sksElement?.textContent || 0);
            
            currentTotalSKS -= sks;
            updateTotalSKS();
            
            row.remove();
            
            // Check if table is empty
            const tbody = document.getElementById('krsTableBody');
            if (tbody.querySelectorAll('tr').length === 0) {
                tbody.innerHTML = `
                    <tr id="emptyState">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 p-6 rounded-full mb-4">
                                    <i class="fas fa-clipboard text-5xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Mata Kuliah</h3>
                                <p class="text-gray-500">Silakan pilih mata kuliah dari daftar sebelah kiri</p>
                            </div>
                        </td>
                    </tr>
                `;
            }
            
            showToast('Mata kuliah berhasil dihapus', 'success');
        }
    }

    function updateTotalSKS() {
        const totalSKSElement = document.getElementById('totalSKS');
        if (totalSKSElement) {
            totalSKSElement.innerHTML = `
                <span class="text-emerald-600">${currentTotalSKS}</span>
                <span class="text-gray-400 text-sm">/ ${maxSKS}</span>
            `;
        }
    }

    function saveDraft() {
        if (currentTotalSKS === 0) {
            alert('Belum ada mata kuliah yang dipilih');
            return;
        }

        // Show loading
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';

        // Simulate AJAX call
        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            showToast('Draft KRS berhasil disimpan', 'success');
        }, 1000);
    }

    function submitKRS() {
        if (currentTotalSKS === 0) {
            alert('Belum ada mata kuliah yang dipilih');
            return;
        }

        if (currentTotalSKS < 12) {
            if (!confirm('Total SKS kurang dari 12. Apakah Anda yakin ingin melanjutkan?')) {
                return;
            }
        }

        // Update modal content
        document.getElementById('totalMK').textContent = selectedCourses.length;
        document.getElementById('confirmTotalSKS').textContent = currentTotalSKS + ' SKS';

        // Show confirmation modal
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function confirmSubmitKRS() {
        // Close modal
        closeConfirmModal();

        // Show loading
        showToast('Mengajukan KRS...', 'info');

        // Simulate AJAX call
        setTimeout(() => {
            showToast('KRS berhasil diajukan! Menunggu persetujuan Dosen PA', 'success');
            
            // In real implementation, reload page or update status
            setTimeout(() => {
                location.reload();
            }, 2000);
        }, 1500);
    }

    function batalkanKRS() {
        if (!confirm('Yakin ingin membatalkan pengajuan KRS? KRS akan kembali ke status Draft dan dapat Anda edit kembali.')) {
            return;
        }

        showToast('Membatalkan pengajuan...', 'info');

        // Simulate AJAX call
        setTimeout(() => {
            showToast('Pengajuan KRS berhasil dibatalkan', 'success');
            location.reload();
        }, 1000);
    }

    function printKRS() {
        window.print();
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function closeDetailMKModal() {
        document.getElementById('detailMKModal').classList.add('hidden');
    }

    function closeModalOnOutside(event) {
        if (event.target.id === 'confirmModal' || event.target.id === 'detailMKModal') {
            event.target.classList.add('hidden');
        }
    }

    function showToast(message, type = 'info') {
        const colors = {
            success: 'bg-emerald-500',
            error: 'bg-red-500',
            info: 'bg-blue-500',
            warning: 'bg-amber-500'
        };

        const icons = {
            success: 'fa-check-circle',
            error: 'fa-times-circle',
            info: 'fa-info-circle',
            warning: 'fa-exclamation-triangle'
        };

        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 ${colors[type]} text-white px-6 py-4 rounded-lg shadow-lg z-50 flex items-center space-x-3 animate-fade-in`;
        toast.innerHTML = `
            <i class="fas ${icons[type]} text-xl"></i>
            <span>${message}</span>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(20px)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmModal();
            closeDetailMKModal();
        }
    });

    // Check for schedule conflicts (would be implemented with actual data)
    function checkScheduleConflict() {
        // Implementation for checking schedule conflicts
        console.log('Checking schedule conflicts...');
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        console.log('KRS page loaded');
        updateTotalSKS();
    });
    </script>
    @endpush

</x-layouts.dashboard>