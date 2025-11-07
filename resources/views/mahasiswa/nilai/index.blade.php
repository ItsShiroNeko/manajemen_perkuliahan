<x-layouts.mahasiswa>
    <x-slot:title>Nilai Mahasiswa</x-slot:title>

    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-home mr-2"></i>
            <a href="" class="hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right mx-2 text-xs"></i>
            <span class="text-emerald-600 font-medium">Nilai Mahasiswa</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">IPK Kumulatif</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ number_format($ipk ?? 3.75, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">dari 4.00</p>
                </div>
                <div class="bg-emerald-100 p-4 rounded-lg">
                    <i class="fas fa-star text-emerald-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-sky-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total SKS Lulus</p>
                    <p class="text-3xl font-bold text-sky-600">{{ $totalSks ?? 120 }}</p>
                    <p class="text-xs text-gray-500 mt-1">SKS</p>
                </div>
                <div class="bg-sky-100 p-4 rounded-lg">
                    <i class="fas fa-graduation-cap text-sky-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Mata Kuliah Lulus</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $mkLulus ?? 40 }}</p>
                    <p class="text-xs text-gray-500 mt-1">Mata Kuliah</p>
                </div>
                <div class="bg-purple-100 p-4 rounded-lg">
                    <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Predikat</p>
                    <p class="text-3xl font-bold text-amber-600">{{ $predikat ?? 'Cum Laude' }}</p>
                    <p class="text-xs text-gray-500 mt-1">Sangat Memuaskan</p>
                </div>
                <div class="bg-amber-100 p-4 rounded-lg">
                    <i class="fas fa-trophy text-amber-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6 card-hover border border-gray-100">
        <div class="flex items-center mb-4">
            <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                <i class="fas fa-filter text-white"></i>
            </div>
            <h2 class="text-lg font-bold text-gray-800">Filter Nilai</h2>
        </div>

        <form method="GET" action="{{ route('nilai.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
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
                    <option value="Ganjil" {{ request('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ request('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-award text-emerald-500 mr-1"></i> Nilai Huruf
                </label>
                <select name="nilai_huruf" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Nilai</option>
                    <option value="A" {{ request('nilai_huruf') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="AB" {{ request('nilai_huruf') == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="B" {{ request('nilai_huruf') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="BC" {{ request('nilai_huruf') == 'BC' ? 'selected' : '' }}>BC</option>
                    <option value="C" {{ request('nilai_huruf') == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ request('nilai_huruf') == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ request('nilai_huruf') == 'E' ? 'selected' : '' }}>E</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-check-circle text-emerald-500 mr-1"></i> Status
                </label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                    <option value="">Semua Status</option>
                    <option value="Lulus" {{ request('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="Tidak Lulus" {{ request('status') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-2.5 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('nilai.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Nilai Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-sky-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                        <i class="fas fa-list-alt text-white"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Daftar Nilai</h2>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-1 text-emerald-500"></i> No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-book mr-1 text-emerald-500"></i> Mata Kuliah
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-credit-card mr-1 text-emerald-500"></i> SKS
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-tasks mr-1 text-emerald-500"></i> Tugas
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-clipboard-question mr-1 text-emerald-500"></i> Quiz
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-file-alt mr-1 text-emerald-500"></i> UTS
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-file-signature mr-1 text-emerald-500"></i> UAS
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-calculator mr-1 text-emerald-500"></i> Nilai Akhir
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-award mr-1 text-emerald-500"></i> Huruf
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-chart-bar mr-1 text-emerald-500"></i> Mutu
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-check-circle mr-1 text-emerald-500"></i> Status
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-cog mr-1 text-emerald-500"></i> Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($nilaiList ?? [] as $index => $nilai)
                    <tr class="hover:bg-emerald-50/50 transition-all duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-700 font-semibold text-sm">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $nilai->krsDetail->kelas->mataKuliah->nama_mk ?? 'Mata Kuliah' }}</div>
                            <div class="flex items-center mt-1 space-x-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                    <i class="fas fa-code text-gray-500 mr-1 text-xs"></i>
                                    {{ $nilai->krsDetail->kelas->mataKuliah->kode_mk ?? 'MK001' }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-700">
                                    {{ $nilai->krsDetail->kelas->nama_kelas ?? 'A' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-sky-100 to-emerald-100 text-sky-800 border border-sky-200">
                                {{ $nilai->krsDetail->kelas->mataKuliah->sks ?? 3 }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($nilai->tugas ?? 0, 1) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($nilai->quiz ?? 0, 1) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($nilai->uts ?? 0, 1) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($nilai->uas ?? 0, 1) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-lg font-bold text-emerald-600">{{ number_format($nilai->nilai_akhir ?? 0, 1) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
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
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl text-xl font-bold bg-gradient-to-br {{ $badgeColor }} text-white shadow-lg">
                                {{ $huruf }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-sm font-bold text-gray-900">{{ number_format($nilai->nilai_mutu ?? 4.0, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($nilai->status == 'Lulus')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-emerald-500 to-green-500 text-white shadow-sm">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Lulus
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-500 to-red-600 text-white shadow-sm">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Tidak Lulus
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button onclick="showDetailNilai({{ $nilai->id }})" class="inline-flex items-center px-3 py-1.5 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-all duration-300 text-sm font-medium shadow-sm hover:shadow-md">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 p-6 rounded-full mb-4">
                                    <i class="fas fa-chart-line text-5xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Nilai</h3>
                                <p class="text-gray-500">Nilai akan muncul setelah dosen menginput nilai Anda</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                
                @if(count($nilaiList ?? []) > 0)
                <tfoot class="bg-gradient-to-r from-emerald-50 to-sky-50 border-t-2 border-emerald-500">
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-right font-bold text-gray-900">Total:</td>
                        <td class="px-6 py-4 text-center font-bold text-emerald-600">{{ $totalSksLulus ?? 120 }} SKS</td>
                        <td colspan="6" class="px-6 py-4"></td>
                        <td class="px-6 py-4 text-center">
                            <div class="text-xs text-gray-600 mb-1">IPK</div>
                            <div class="text-2xl font-bold text-emerald-600">{{ number_format($ipk ?? 3.75, 2) }}</div>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($nilaiList) && method_exists($nilaiList, 'links'))
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $nilaiList->links() }}
        </div>
        @endif
    </div>

    <!-- Keterangan Nilai -->
    <div class="mt-6 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-2 rounded-lg mr-3">
                <i class="fas fa-info-circle text-white"></i>
            </div>
            Keterangan Penilaian
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Konversi Nilai Huruf:</h4>
                <div class="space-y-2">
                    <div class="flex items-center justify-between p-2 bg-emerald-50 rounded-lg">
                        <span class="font-semibold text-emerald-700">A</span>
                        <span class="text-sm text-gray-600">85 - 100 (Mutu: 4.00)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-green-50 rounded-lg">
                        <span class="font-semibold text-green-700">AB</span>
                        <span class="text-sm text-gray-600">80 - 84 (Mutu: 3.50)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-lime-50 rounded-lg">
                        <span class="font-semibold text-lime-700">B</span>
                        <span class="text-sm text-gray-600">75 - 79 (Mutu: 3.00)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-yellow-50 rounded-lg">
                        <span class="font-semibold text-yellow-700">BC</span>
                        <span class="text-sm text-gray-600">70 - 74 (Mutu: 2.50)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-amber-50 rounded-lg">
                        <span class="font-semibold text-amber-700">C</span>
                        <span class="text-sm text-gray-600">65 - 69 (Mutu: 2.00)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-orange-50 rounded-lg">
                        <span class="font-semibold text-orange-700">D</span>
                        <span class="text-sm text-gray-600">60 - 64 (Mutu: 1.00)</span>
                    </div>
                    <div class="flex items-center justify-between p-2 bg-red-50 rounded-lg">
                        <span class="font-semibold text-red-700">E</span>
                        <span class="text-sm text-gray-600">0 - 59 (Mutu: 0.00)</span>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Komponen Penilaian:</h4>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Tugas</span>
                            <span class="text-sm font-semibold text-emerald-600">20%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="progress-bar bg-gradient-to-r from-emerald-500 to-green-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Quiz</span>
                            <span class="text-sm font-semibold text-sky-600">20%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="progress-bar bg-gradient-to-r from-sky-500 to-blue-500 h-2 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">UTS</span>
                            <span class="text-sm font-semibold text-purple-600">30%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="progress-bar bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">UAS</span>
                            <span class="text-sm font-semibold text-amber-600">30%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="progress-bar bg-gradient-to-r from-amber-500 to-orange-500 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i>
                        Catatan Penting:
                    </h4>
                    <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                        <li>Batas kelulusan minimal adalah nilai C (2.00)</li>
                        <li>IPK dihitung dari semua mata kuliah yang telah diambil</li>
                        <li>Nilai dapat diajukan untuk perbaikan sesuai ketentuan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Nilai -->
    <div id="detailNilaiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 backdrop-blur-sm" onclick="closeModalOnOutside(event)">
        <div class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-2/3 shadow-2xl rounded-2xl bg-white" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 p-3 rounded-xl mr-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Detail Nilai Mahasiswa</h3>
                </div>
                <button onclick="closeNilaiModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-all">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div id="nilaiModalContent" class="mt-4">
                <div class="flex items-center justify-center py-8">
                    <i class="fas fa-spinner fa-spin text-3xl text-emerald-500"></i>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function showDetailNilai(nilaiId) {
        const modal = document.getElementById('detailNilaiModal');
        modal.classList.remove('hidden');
        
        // Simulasi fetch data - ganti dengan actual API call
        setTimeout(() => {
            document.getElementById('nilaiModalContent').innerHTML = `
                <div class="space-y-6">
                    <!-- Header Info -->
                    <div class="bg-gradient-to-r from-emerald-50 to-sky-50 p-6 rounded-xl border border-emerald-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <i class="fas fa-book text-emerald-500 mr-2"></i>
                                    Mata Kuliah
                                </label>
                                <p class="text-lg font-bold text-gray-900">Pemrograman Web</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 mt-1">
                                    <i class="fas fa-code text-gray-500 mr-1"></i>
                                    MK001
                                </span>
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-600 uppercase tracking-wide flex items-center mb-2">
                                    <i class="fas fa-users text-emerald-500 mr-2"></i>
                                    Kelas & SKS
                                </label>
                                <p class="text-lg font-bold text-gray-900">Kelas A</p>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-gradient-to-r from-sky-100 to-emerald-100 text-sky-800 mt-1">
                                    3 SKS
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Komponen Nilai -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-clipboard-list text-emerald-500 mr-2"></i>
                            Komponen Penilaian
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white border-2 border-emerald-200 rounded-xl p-4 text-center hover:shadow-lg transition-all">
                                <div class="bg-emerald-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-tasks text-emerald-600 text-xl"></i>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">Tugas</p>
                                <p class="text-2xl font-bold text-emerald-600">85</p>
                                <p class="text-xs text-gray-500 mt-1">(20%)</p>
                            </div>
                            <div class="bg-white border-2 border-sky-200 rounded-xl p-4 text-center hover:shadow-lg transition-all">
                                <div class="bg-sky-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-clipboard-question text-sky-600 text-xl"></i>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">Quiz</p>
                                <p class="text-2xl font-bold text-sky-600">88</p>
                                <p class="text-xs text-gray-500 mt-1">(20%)</p>
                            </div>
                            <div class="bg-white border-2 border-purple-200 rounded-xl p-4 text-center hover:shadow-lg transition-all">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-file-alt text-purple-600 text-xl"></i>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">UTS</p>
                                <p class="text-2xl font-bold text-purple-600">82</p>
                                <p class="text-xs text-gray-500 mt-1">(30%)</p>
                            </div>
                            <div class="bg-white border-2 border-amber-200 rounded-xl p-4 text-center hover:shadow-lg transition-all">
                                <div class="bg-amber-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-file-signature text-amber-600 text-xl"></i>
                                </div>
                                <p class="text-xs text-gray-600 mb-1">UAS</p>
                                <p class="text-2xl font-bold text-amber-600">90</p>
                                <p class="text-xs text-gray-500 mt-1">(30%)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Akhir -->
                    <div class="bg-gradient-to-br from-emerald-500 to-sky-500 rounded-xl p-6 text-white">
                        <h4 class="text-lg font-bold mb-4 flex items-center">
                            <i class="fas fa-trophy mr-2"></i>
                            Hasil Akhir
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4 text-center">
                                <p class="text-sm mb-2">Nilai Akhir</p>
                                <p class="text-4xl font-bold">86.5</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4 text-center">
                                <p class="text-sm mb-2">Nilai Huruf</p>
                                <p class="text-4xl font-bold">A</p>
                            </div>
                            <div class="bg-white/20 backdrop-blur rounded-lg p-4 text-center">
                                <p class="text-sm mb-2">Nilai Mutu</p>
                                <p class="text-4xl font-bold">4.00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Perkembangan (Optional) -->
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-chart-area text-emerald-500 mr-2"></i>
                            Visualisasi Nilai
                        </h4>
                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium">Tugas (85)</span>
                                        <span class="text-sm font-semibold text-emerald-600">85%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-emerald-500 to-green-500 h-3 rounded-full transition-all duration-1000" style="width: 85%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium">Quiz (88)</span>
                                        <span class="text-sm font-semibold text-sky-600">88%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-sky-500 to-blue-500 h-3 rounded-full transition-all duration-1000" style="width: 88%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium">UTS (82)</span>
                                        <span class="text-sm font-semibold text-purple-600">82%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-1000" style="width: 82%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium">UAS (90)</span>
                                        <span class="text-sm font-semibold text-amber-600">90%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 h-3 rounded-full transition-all duration-1000" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Catatan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <h5 class="font-semibold text-green-900 mb-2 flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Status
                            </h5>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-emerald-500 to-green-500 text-white">
                                <i class="fas fa-check-circle mr-1"></i>
                                Lulus
                            </span>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <h5 class="font-semibold text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                Tanggal Input
                            </h5>
                            <p class="text-sm text-blue-800">15 Januari 2025</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button onclick="closeNilaiModal()" class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all duration-300 font-medium">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                        <button onclick="printDetailNilai()" class="flex-1 bg-gradient-to-r from-emerald-600 to-sky-600 text-white px-6 py-3 rounded-lg hover:from-emerald-700 hover:to-sky-700 transition-all duration-300 font-medium shadow-md hover:shadow-lg">
                            <i class="fas fa-print mr-2"></i>Cetak Detail
                        </button>
                    </div>
                </div>
            `;
        }, 500);
    }

    function closeNilaiModal() {
        document.getElementById('detailNilaiModal').classList.add('hidden');
    }

    function closeModalOnOutside(event) {
        if (event.target.id === 'detailNilaiModal') {
            closeNilaiModal();
        }
    }

    function printTranskrip() {
        window.print();
    }

    function exportPDF() {
        alert('Fitur export PDF akan segera tersedia!');
        // Implementasi export PDF
    }

    function printDetailNilai() {
        window.print();
    }

    // Keyboard shortcut
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeNilaiModal();
        }
    });

    // Auto calculate average on page load
    window.addEventListener('load', function() {
        console.log('Halaman nilai berhasil dimuat');
    });
    </script>
    @endpush

</x-layouts.dashboard>