<x-layouts.dashboard title="Detail Dosen">
    <div class="bg-white p-6 rounded shadow w-full">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Detail Dosen</h1>
            <a href="/dosen" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
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
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 mb-6 text-white">
                <div class="flex items-center gap-6">
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center text-green-600 text-4xl font-bold">
                        <span id="initial"></span>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold mb-2" id="nama"></h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="opacity-80">NIDN</p>
                                <p class="font-semibold text-lg" id="nidn"></p>
                            </div>
                            <div>
                                <p class="opacity-80">Status</p>
                                <p class="font-semibold text-lg" id="statusHeader"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button onclick="openEditModal(currentDosenId)" class="bg-white text-green-600 px-4 py-2 rounded hover:bg-gray-100 mb-2 block w-full">
                            Edit Data
                        </button>
                        <button onclick="confirmDelete(currentDosenId)" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 block w-full">
                            Arsipkan
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="border-b mb-6">
                <div class="flex gap-4">
                    <button onclick="showTab('biodata')" id="tabBiodata" class="px-4 py-2 border-b-2 border-green-500 text-green-600 font-semibold">
                        Data Pribadi
                    </button>
                    <button onclick="showTab('kepegawaian')" id="tabKepegawaian" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Data Kepegawaian
                    </button>
                    <button onclick="showTab('kontak')" id="tabKontak" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Kontak
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
                            <label class="text-sm text-gray-600">Gelar</label>
                            <p class="font-semibold text-gray-800" id="gelar"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Jenis Kelamin</label>
                            <p class="font-semibold text-gray-800" id="jenisKelamin"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Tanggal Lahir</label>
                            <p class="font-semibold text-gray-800" id="tanggalLahir"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm text-gray-600">Tempat Lahir</label>
                            <p class="font-semibold text-gray-800" id="tempatLahir"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm text-gray-600">Alamat</label>
                            <p class="font-semibold text-gray-800" id="alamat"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Content: Kepegawaian --}}
            <div id="contentKepegawaian" class="space-y-6 hidden">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Informasi Kepegawaian</h3>
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="text-sm text-gray-600">NIDN</label>
                            <p class="font-semibold text-gray-800" id="nidnKepegawaian"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">NIP</label>
                            <p class="font-semibold text-gray-800" id="nip"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Jurusan</label>
                            <p class="font-semibold text-gray-800" id="jurusan"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Status Kepegawaian</label>
                            <p class="font-semibold text-gray-800" id="statusKepegawaian"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Jabatan</label>
                            <p class="font-semibold text-gray-800" id="jabatan"></p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-600">Status</label>
                            <p class="font-semibold text-gray-800" id="status"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab Content: Kontak --}}
            <div id="contentKontak" class="space-y-6 hidden">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4 text-gray-700">Kontak</h3>
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
    @include('components.modal.dosen.modal-edit')

    {{-- Script --}}
    <script src="{{ asset('js/admin/dosen/dosen-detail.js') }}"></script>
    <script src="{{ asset('js/admin/dosen/dosen-edit.js') }}"></script>
</x-layouts.dashboard>