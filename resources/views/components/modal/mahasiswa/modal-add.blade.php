<div id="modalAdd" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 m-4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Tambah Data Mahasiswa</h2>
            <form id="formAddMahasiswa" onsubmit="createMahasiswa(); return false;">
                @csrf
                
                {{-- Data Akademik --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Akademik</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addNim" class="block mb-1 text-sm">NIM <span class="text-red-500">*</span></label>
                            <input type="text" id="addNim" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="addJurusanId" class="block mb-1 text-sm">Jurusan <span class="text-red-500">*</span></label>
                            <select id="addJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                        </div>
                        <div>
                            <label for="addAngkatan" class="block mb-1 text-sm">Angkatan <span class="text-red-500">*</span></label>
                            <input type="number" id="addAngkatan" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="addStatus" class="block mb-1 text-sm">Status <span class="text-red-500">*</span></label>
                            <select id="addStatus" class="border p-2 w-full rounded" required>
                                <option value="AKTIF">Aktif</option>
                                <option value="CUTI">Cuti</option>
                                <option value="LULUS">Lulus</option>
                                <option value="DO">DO</option>
                            </select>
                        </div>
                        <div>
                            <label for="addSemester" class="block mb-1 text-sm">Semester Saat Ini <span class="text-red-500">*</span></label>
                            <input type="number" id="addSemester" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="addUserId" class="block mb-1 text-sm">User ID <span class="text-red-500">*</span></label>
                            <input type="number" id="addUserId" class="border p-2 w-full rounded" required>
                        </div>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Pribadi</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="addNamaLengkap" class="block mb-1 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="addNamaLengkap" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="addJenisKelamin" class="block mb-1 text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select id="addJenisKelamin" class="border p-2 w-full rounded" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="addTanggalLahir" class="block mb-1 text-sm">Tanggal Lahir</label>
                            <input type="date" id="addTanggalLahir" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="addTempatLahir" class="block mb-1 text-sm">Tempat Lahir</label>
                            <input type="text" id="addTempatLahir" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="addAlamat" class="block mb-1 text-sm">Alamat</label>
                            <textarea id="addAlamat" rows="2" class="border p-2 w-full rounded"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Kontak</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addNoHp" class="block mb-1 text-sm">No. HP</label>
                            <input type="text" id="addNoHp" class="border p-2 w-full rounded">
                        </div>
                        <div>
                            <label for="addEmailPribadi" class="block mb-1 text-sm">Email Pribadi</label>
                            <input type="email" id="addEmailPribadi" class="border p-2 w-full rounded">
                        </div>
                    </div>
                </div>

                {{-- Data Orang Tua --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Orang Tua</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addNamaAyah" class="block mb-1 text-sm">Nama Ayah</label>
                            <input type="text" id="addNamaAyah" class="border p-2 w-full rounded">
                        </div>
                        <div>
                            <label for="addNamaIbu" class="block mb-1 text-sm">Nama Ibu</label>
                            <input type="text" id="addNamaIbu" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="addNoHpOrtu" class="block mb-1 text-sm">No. HP Orang Tua</label>
                            <input type="text" id="addNoHpOrtu" class="border p-2 w-full rounded">
                        </div>
                    </div>
                </div>

                {{-- Data Akademik Lanjutan --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Akademik Lanjutan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addIpk" class="block mb-1 text-sm">IPK</label>
                            <input type="number" step="0.01" id="addIpk" class="border p-2 w-full rounded" placeholder="0.00">
                        </div>
                        <div>
                            <label for="addTotalSks" class="block mb-1 text-sm">Total SKS</label>
                            <input type="number" id="addTotalSks" class="border p-2 w-full rounded" placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>