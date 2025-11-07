<x-layouts.mahasiswa>
    
    <x-slot:title>Jadwal Kuliah</x-slot:title>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-home mr-2"></i>
            <a href="" class="hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <span class="text-emerald-600 font-medium">Jadwal Kuliah</span>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 card-hover border border-gray-100">

        <form method="GET" action="{{ route('jadwal.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-day text-emerald-500 mr-1"></i> Hari
                </label>
                <select name="hari" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Hari</option>
                    <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ request('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-building text-emerald-500 mr-1"></i> Jurusan
                </label>
                <select name="jurusan_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusanList ?? [] as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-layer-group text-emerald-500 mr-1"></i> Semester
                </label>
                <select name="semester" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag text-emerald-500 mr-1"></i> Jenis MK
                </label>
                <select name="jenis" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Jenis</option>
                    <option value="Wajib" {{ request('jenis') == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                    <option value="Pilihan" {{ request('jenis') == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-2.5 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('jadwal.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Jadwal Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-sky-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                        <i class="fas fa-list text-white"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Daftar Jadwal Kuliah</h2>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-code mr-1 text-emerald-500"></i> Kode
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-book-open mr-1 text-emerald-500"></i> Mata Kuliah
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-credit-card mr-1 text-emerald-500"></i> SKS
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-users mr-1 text-emerald-500"></i> Kelas
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-clock mr-1 text-emerald-500"></i> Hari/Waktu
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-door-open mr-1 text-emerald-500"></i> Ruangan
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-chalkboard-teacher mr-1 text-emerald-500"></i> Dosen
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-tag mr-1 text-emerald-500"></i> Jenis
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-cog mr-1 text-emerald-500"></i> Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mataKuliahList ?? [] as $mk)
                        @foreach($mk->kelas ?? [] as $kelas)
                        <tr class="hover:bg-emerald-50/50 transition-all duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">{{ $mk->kode_mk }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $mk->nama_mk }}</div>
                                <div class="flex items-center mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                        <i class="fas fa-building text-gray-500 mr-1 text-xs"></i>
                                        {{ $mk->jurusan->nama_jurusan ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-sky-100 to-emerald-100 text-sky-800 border border-sky-200">
                                    <i class="fas fa-credit-card mr-1 text-xs"></i>
                                    {{ $mk->sks }} SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $kelas->nama_kelas ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm">
                                    <div class="bg-emerald-100 p-1.5 rounded-lg mr-2">
                                        <i class="fas fa-calendar text-emerald-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $kelas->hari ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $kelas->jam_mulai ?? '' }} - {{ $kelas->jam_selesai ?? '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-amber-100 text-amber-800">
                                    <i class="fas fa-map-marker-alt mr-1 text-xs"></i>
                                    {{ $kelas->ruangan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-sky-500 flex items-center justify-center text-white text-xs font-bold mr-2">
                                        {{ substr($kelas->dosen->nama ?? 'D', 0, 1) }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $kelas->dosen->nama ?? '-' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($mk->jenis == 'Wajib')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-emerald-500 to-green-500 text-white shadow-sm">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Wajib
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-sm">
                                        <i class="fas fa-star mr-1"></i>
                                        Pilihan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button onclick="showDetail({{ $mk->id }})" class="inline-flex items-center px-3 py-1.5 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md">
                                    <i class="fas fa-eye mr-1"></i>
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 p-6 rounded-full mb-4">
                                        <i class="fas fa-calendar-times text-5xl text-gray-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Jadwal</h3>
                                    <p class="text-gray-500">Tidak ada jadwal kuliah yang sesuai dengan filter yang dipilih</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($mataKuliahList) && method_exists($mataKuliahList, 'links'))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $mataKuliahList->links() }}
        </div>
        @endif
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm" onclick="closeModalOnOutside(event)">
        <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-2xl bg-white" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-3 rounded-xl mr-3">
                        <i class="fas fa-book-open text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Detail Mata Kuliah</h3>
                </div>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-all">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div id="modalContent" class="mt-4">
                <div class="flex items-center justify-center py-8">
                    <i class="fas fa-spinner fa-spin text-3xl text-emerald-500"></i>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function showDetail(mkId) {
        const modal = document.getElementById('detailModal');
        modal.classList.remove('hidden');
        
        // Simulasi fetch data - ganti dengan actual API call
        setTimeout(() => {
            document.getElementById('modalContent').innerHTML = `
                <div class="space-y-6">
                    <div class="bg-gradient-to-r from-emerald-50 to-sky-50 p-4 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-600 uppercase tracking-wide">Kode Mata Kuliah</label>
                                <p class="text-lg font-bold text-gray-900 mt-1">MK001</p>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-600 uppercase tracking-wide">SKS</label>
                                <p class="text-lg font-bold text-gray-900 mt-1">3 SKS</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="fas fa-book text-emerald-500 mr-2"></i>
                            Nama Mata Kuliah
                        </label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">Pemrograman Web</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="fas fa-layer-group text-emerald-500 mr-2"></i>
                            Semester Rekomendasi
                        </label>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">Semester 4</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="fas fa-tag text-emerald-500 mr-2"></i>
                            Jenis Mata Kuliah
                        </label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-emerald-500 to-green-500 text-white">
                            <i class="fas fa-check-circle mr-1"></i> Wajib
                        </span>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700 flex items-center mb-2">
                            <i class="fas fa-align-left text-emerald-500 mr-2"></i>
                            Deskripsi
                        </label>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg leading-relaxed">
                            Mata kuliah ini membahas tentang pengembangan aplikasi web modern menggunakan berbagai teknologi dan framework terkini.
                        </p>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button onclick="closeModal()" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                        <button class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-3 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                            <i class="fas fa-print mr-2"></i>Cetak Detail
                        </button>
                    </div>
                </div>
            `;
        }, 500);
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function closeModalOnOutside(event) {
        if (event.target.id === 'detailModal') {
            closeModal();
        }
    }

    function printJadwal() {
        window.print();
    }

    // Keyboard shortcut
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    </script>
    @endpush

</x-layouts.dashboard>