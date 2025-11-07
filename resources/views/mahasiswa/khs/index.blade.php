<x-layouts.mahasiswa>
    <x-slot:title>Kartu Hasil Studi (KHS)</x-slot:title>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-home mr-2"></i>
            <a href="" class="hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <span class="text-emerald-600 font-medium">Kartu Hasil Studi</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-emerald-500 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">IPK Kumulatif</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ number_format($ipkKumulatif ?? 3.75, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">dari 4.00</p>
                </div>
                <div class="bg-emerald-100 p-4 rounded-lg">
                    <i class="fas fa-trophy text-emerald-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-sky-500 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total SKS</p>
                    <p class="text-3xl font-bold text-sky-600">{{ $totalSks ?? 120 }}</p>
                    <p class="text-xs text-gray-500 mt-1">SKS Lulus</p>
                </div>
                <div class="bg-sky-100 p-4 rounded-lg">
                    <i class="fas fa-graduation-cap text-sky-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-purple-500 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Semester Aktif</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $semesterAktif ?? 6 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Semester</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-amber-500 animate-fade-in" style="animation-delay: 0.3s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">IP Tertinggi</p>
                    <p class="text-3xl font-bold text-amber-600">{{ number_format($ipTertinggi ?? 3.95, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">Semester {{ $semesterTertinggi ?? 4 }}</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg">
                    <i class="fas fa-star text-amber-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Chart -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100 card-hover">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Grafik Perkembangan Prestasi</h2>
            </div>
            <div class="flex items-center space-x-2">
                <span class="flex items-center text-sm">
                    <span class="w-3 h-3 bg-emerald-500 rounded-full mr-2"></span>
                    IP Semester
                </span>
                <span class="flex items-center text-sm ml-4">
                    <span class="w-3 h-3 bg-sky-500 rounded-full mr-2"></span>
                    IPK
                </span>
            </div>
        </div>
        
        <div class="relative h-64">
            <!-- Placeholder untuk Chart - Gunakan Chart.js atau library lain -->
            <canvas id="performanceChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 card-hover border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                <i class="fas fa-filter text-white"></i>
            </div>
            <h2 class="text-lg font-bold text-gray-800">Filter KHS</h2>
        </div>

        <form method="GET" action="{{ route('khs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar text-emerald-500 mr-1"></i> Tahun Akademik
                </label>
                <select name="tahun" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}/{{ $i+1 }}</option>
                    @endfor
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
                    <i class="fas fa-sort-amount-down text-emerald-500 mr-1"></i> Urutkan
                </label>
                <select name="sort" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-2.5 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('khs.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- KHS List -->
    <div class="space-y-4">
        @forelse($khsList ?? [] as $index => $khs)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 card-hover animate-fade-in" style="animation-delay: {{ $index * 0.05 }}s;">
            <!-- Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-sky-500 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center text-white">
                    <div class="bg-white/20 backdrop-blur p-3 rounded-lg mr-4">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">{{ $khs->semester->nama_semester ?? 'Semester ' . ($index + 1) }}</h3>
                        <p class="text-sm text-white/90">{{ $khs->semester->tahun_akademik ?? '2024/2025' }} - {{ $khs->semester->jenis ?? 'Ganjil' }}</p>
                    </div>
                </div>
                <button onclick="toggleDetail({{ $khs->id }})" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-4 py-2 rounded-lg transition-all font-medium">
                    <i class="fas fa-chevron-down mr-2" id="icon-{{ $khs->id }}"></i>
                    Detail
                </button>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200 bg-gray-50">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="bg-emerald-100 p-2 rounded-lg">
                            <i class="fas fa-star text-emerald-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">IP Semester</p>
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($khs->ip_semester ?? 3.75, 2) }}</p>
                </div>
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="bg-sky-100 p-2 rounded-lg">
                            <i class="fas fa-trophy text-sky-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">IPK</p>
                    <p class="text-2xl font-bold text-sky-600">{{ number_format($khs->ipk ?? 3.70, 2) }}</p>
                </div>
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-graduation-cap text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">SKS Semester</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $khs->sks_semester ?? 20 }}</p>
                </div>
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="bg-amber-100 p-2 rounded-lg">
                            <i class="fas fa-layer-group text-amber-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-1">SKS Kumulatif</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $khs->sks_kumulatif ?? 120 }}</p>
                </div>
            </div>

            <!-- Detail Section (Collapsible) -->
            <div id="detail-{{ $khs->id }}" class="hidden px-6 py-4 border-t border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Kode MK</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Mata Kuliah</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">SKS</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Nilai</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Huruf</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Mutu</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($khs->nilai ?? [] as $idx => $nilai)
                            <tr class="hover:bg-emerald-50/50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $idx + 1 }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $nilai->krsDetail->kelas->mataKuliah->kode_mk ?? 'MK00' . ($idx + 1) }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $nilai->krsDetail->kelas->mataKuliah->nama_mk ?? 'Mata Kuliah ' . ($idx + 1) }}</div>
                                    <div class="text-xs text-gray-500">Kelas {{ $nilai->krsDetail->kelas->nama_kelas ?? 'A' }}</div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-800">
                                        {{ $nilai->krsDetail->kelas->mataKuliah->sks ?? 3 }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">{{ number_format($nilai->nilai_akhir ?? 85, 1) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $huruf = $nilai->nilai_huruf ?? 'A';
                                        $badgeColor = match($huruf) {
                                            'A' => 'from-emerald-500 to-green-500',
                                            'AB' => 'from-green-500 to-lime-500',
                                            'B' => 'from-lime-500 to-yellow-500',
                                            'BC' => 'from-yellow-500 to-amber-500',
                                            'C' => 'from-amber-500 to-orange-500',
                                            'D' => 'from-orange-500 to-red-500',
                                            'E' => 'from-red-500 to-red-600',
                                            default => 'from-gray-500 to-gray-600'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-lg font-bold bg-gradient-to-br {{ $badgeColor }} text-white shadow-sm">
                                        {{ $huruf }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center text-sm font-bold text-gray-900">{{ number_format($nilai->nilai_mutu ?? 4.0, 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($nilai->status == 'Lulus')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Lulus
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Tidak Lulus
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 mt-4 pt-4 border-t border-gray-200">
                    <button onclick="printKHS({{ $khs->id }})" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all duration-300 font-medium shadow-sm">
                        <i class="fas fa-print mr-2"></i>Cetak KHS
                    </button>
                    <button onclick="downloadKHS({{ $khs->id }})" class="bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-4 py-2 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i>Download PDF
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-lg p-12 text-center border border-gray-100">
            <div class="flex flex-col items-center justify-center">
                <div class="bg-gray-100 p-8 rounded-full mb-4">
                    <i class="fas fa-file-alt text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data KHS</h3>
                <p class="text-gray-500">KHS akan muncul setelah nilai semester diinput oleh akademik</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($khsList) && method_exists($khsList, 'links'))
    <div class="mt-6">
        {{ $khsList->links() }}
    </div>
    @endif

    <!-- Summary Card -->
    <div class="mt-6 bg-gradient-to-br from-emerald-500 to-sky-500 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold mb-2">Ringkasan Prestasi Akademik</h3>
                <p class="text-sm text-white/90">Total pencapaian selama masa studi</p>
            </div>
            <button onclick="showDetailTranskrip()" class="bg-white/20 hover:bg-white/30 backdrop-blur px-6 py-3 rounded-lg transition-all font-medium">
                <i class="fas fa-chart-bar mr-2"></i>
                Lihat Transkrip Lengkap
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <p class="text-sm text-white/80 mb-1">IPK Kumulatif</p>
                <p class="text-3xl font-bold">{{ number_format($ipkKumulatif ?? 3.75, 2) }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>Sangat Memuaskan</span>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <p class="text-sm text-white/80 mb-1">Total SKS Lulus</p>
                <p class="text-3xl font-bold">{{ $totalSks ?? 120 }} / 144</p>
                <div class="mt-2 w-full bg-white/20 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full" style="width: {{ (($totalSks ?? 120) / 144) * 100 }}%"></div>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                <p class="text-sm text-white/80 mb-1">Predikat</p>
                <p class="text-3xl font-bold">{{ $predikat ?? 'Cum Laude' }}</p>
                <div class="mt-2 flex items-center text-sm">
                    <i class="fas fa-medal mr-1"></i>
                    <span>Kandidat Wisuda</span>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Initialize Chart
    const ctx = document.getElementById('performanceChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6'],
                datasets: [
                    {
                        label: 'IP Semester',
                        data: [3.5, 3.7, 3.6, 3.8, 3.75, 3.9],
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'IPK',
                        data: [3.5, 3.6, 3.63, 3.68, 3.7, 3.75],
                        borderColor: 'rgb(14, 165, 233)',
                        backgroundColor: 'rgba(14, 165, 233, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 0,
                        max: 4,
                        ticks: {
                            stepSize: 0.5
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    }

    function toggleDetail(khsId) {
        const detail = document.getElementById(`detail-${khsId}`);
        const icon = document.getElementById(`icon-${khsId}`);
        
        if (detail.classList.contains('hidden')) {
            detail.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            detail.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    function printKHS(khsId) {
        window.print();
    }

    function downloadKHS(khsId) {
        alert('Download KHS PDF akan segera tersedia!');
        // Implementasi download PDF
    }

    </script>
    @endpush

</x-layouts.dashboard>