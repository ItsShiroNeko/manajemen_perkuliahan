<x-layouts.dashboard title="Detail Mahasiswa">
    <div class="bg-white p-6 rounded shadow w-full">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Detail Mahasiswa</h1>
            <a href="/mahasiswa" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Kembali
            </a>
        </div>

        {{-- Loading State --}}
        <div id="loading" class="text-center py-8">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
            <p class="mt-2 text-gray-600">Memuat data...</p>
        </div>

        {{-- Content --}}
        <div id="content" class="hidden">
            {{-- Photo & Quick Info --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 mb-6 text-white">
                <div class="flex items-center gap-6">
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-blue-600 text-4xl font-bold">
                        <span id="initial"></span>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold mb-2" id="nama"></h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="opacity-80">NIM</p>
                                <p class="font-semibold text-lg" id="nim"></p>
                            </div>
                            <div>
                                <p class="opacity-80">Status</p>
                                <p class="font-semibold text-lg" id="statusHeader"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button onclick="openEditModal(currentMahasiswaId)" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-100 mb-2 block w-full">
                            Edit Data
                        </button>
                        <button onclick="confirmDelete()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 block w-full">
                            Arsipkan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="border-b mb-6">
                <div class="flex gap-4">
                    <button onclick="showTab('biodata')" id="tabBiodata" class="px-4 py-2 border-b-2 border-blue-500 text-blue-600 font-semibold">
                        Data Pribadi
                    </button>
                    <button onclick="showTab('akademik')" id="tabAkademik" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Data Akademik
                    </button>
                    <button onclick="showTab('kontak')" id="tabKontak" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Kontak & Keluarga
                    </button>
                </div>
            </div>

            {{-- Tab Content: Biodata --}}
            <div id="contentBiodata" class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Informasi Pribadi</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm text-gray-600">Nama Lengkap</label>
                            <p class="font-semibold text-gray-800" id="namaLengkap"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Jenis Kelamin</label>
                            <p class="font-semibold text-gray-800" id="jenisKelamin"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Tempat Lahir</label>
                            <p class="font-semibold text-gray-800" id="tempatLahir"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Tanggal Lahir</label>
                            <p class="font-semibold text-gray-800" id="tanggalLahir"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm text-gray-600">Alamat</label>
                            <p class="font-semibold text-gray-800" id="alamat"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Content: Akademik --}}
            <div id="contentAkademik" class="space-y-6 hidden">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Informasi Akademik</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="text-sm text-gray-600">NIM</label>
                            <p class="font-semibold text-gray-800" id="nimAkademik"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Jurusan</label>
                            <p class="font-semibold text-gray-800" id="jurusan"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Angkatan</label>
                            <p class="font-semibold text-gray-800" id="angkatan"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Status</label>
                            <p class="font-semibold text-gray-800" id="status"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Semester Saat Ini</label>
                            <p class="font-semibold text-gray-800" id="semester"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Total SKS</label>
                            <p class="font-semibold text-gray-800" id="totalSks"></p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-blue-50 p-6 rounded-lg border border-green-200">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Prestasi Akademik</h3>
                    <div class="flex justify-around">
                        <div class="text-center">
                            <p class="text-4xl font-bold text-green-600" id="ipkBesar"></p>
                            <p class="text-sm text-gray-600 mt-2">IPK</p>
                        </div>
                        <div class="border-l border-gray-300"></div>
                        <div class="text-center">
                            <p class="text-4xl font-bold text-blue-600" id="totalSksBesar"></p>
                            <p class="text-sm text-gray-600 mt-2">Total SKS</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Content: Kontak --}}
            <div id="contentKontak" class="space-y-6 hidden">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Kontak Mahasiswa</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm text-gray-600">No. HP</label>
                            <p class="font-semibold text-gray-800" id="noHp"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Email Pribadi</label>
                            <p class="font-semibold text-gray-800" id="emailPribadi"></p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Data Orang Tua</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm text-gray-600">Nama Ayah</label>
                            <p class="font-semibold text-gray-800" id="namaAyah"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Nama Ibu</label>
                            <p class="font-semibold text-gray-800" id="namaIbu"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm text-gray-600">No. HP Orang Tua</label>
                            <p class="font-semibold text-gray-800" id="noHpOrtu"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Metadata --}}
            <div class="mt-8 pt-6 border-t">
                <div class="grid grid-cols-3 gap-4 text-sm text-gray-600">
                    <div>
                        <label class="block mb-1">Dibuat pada</label>
                        <p class="font-semibold text-gray-800" id="createdAt"></p>
                    </div>
                    <div>
                        <label class="block mb-1">Terakhir diupdate</label>
                        <p class="font-semibold text-gray-800" id="updatedAt"></p>
                    </div>
                    <div>
                        <label class="block mb-1">User ID</label>
                        <p class="font-semibold text-gray-800" id="userId"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    @include('components.modal.mahasiswa.modal-edit')

    {{-- Script --}}
    <script src="{{ asset('js/mahasiswa/mahasiswa-detail.js') }}"></script>
    <script src="{{ asset('js/mahasiswa/mahasiswa-edit.js') }}"></script>
</x-layouts.dashboard>