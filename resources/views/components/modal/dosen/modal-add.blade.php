<div id="modalAdd" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 m-4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Tambah Data Dosen</h2>
            <form id="formAddDosen" onsubmit="createDosen(); return false;">
                @csrf
                
                {{-- Data Identitas --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Identitas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addNidn" class="block mb-1 text-sm">NIDN <span class="text-red-500">*</span></label>
                            <input type="text" id="addNidn" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="addNip" class="block mb-1 text-sm">NIP</label>
                            <input type="text" id="addNip" class="border p-2 w-full rounded">
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
                        <div>
                            <label for="addGelarDepan" class="block mb-1 text-sm">Gelar Depan</label>
                            <input type="text" id="addGelarDepan" class="border p-2 w-full rounded" placeholder="Dr., Prof., dll">
                        </div>
                        <div>
                            <label for="addGelarBelakang" class="block mb-1 text-sm">Gelar Belakang</label>
                            <input type="text" id="addGelarBelakang" class="border p-2 w-full rounded" placeholder="S.Kom., M.T., Ph.D., dll">
                        </div>
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

                {{-- Data Kepegawaian --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Kepegawaian</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="addJurusanId" class="block mb-1 text-sm">Jurusan <span class="text-red-500">*</span></label>
                            <select id="addJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                        </div>
                        <div>
                            <label for="addStatusKepegawaian" class="block mb-1 text-sm">Status Kepegawaian <span class="text-red-500">*</span></label>
                            <select id="addStatusKepegawaian" class="border p-2 w-full rounded" required>
                                <option value="">Pilih</option>
                                <option value="PNS">PNS</option>
                                <option value="CPNS">CPNS</option>
                                <option value="HONORER">Honorer</option>
                                <option value="KONTRAK">Kontrak</option>
                                <option value="TETAP">Tetap</option>
                            </select>
                        </div>
                        <div>
                            <label for="addJabatan" class="block mb-1 text-sm">Jabatan</label>
                            <input type="text" id="addJabatan" class="border p-2 w-full rounded" placeholder="Dosen, Lektor, dll">
                        </div>
                        <div>
                            <label for="addStatus" class="block mb-1 text-sm">Status <span class="text-red-500">*</span></label>
                            <select id="addStatus" class="border p-2 w-full rounded" required>
                                <option value="AKTIF">Aktif</option>
                                <option value="CUTI">Cuti</option>
                                <option value="PENSIUN">Pensiun</option>
                                <option value="NONAKTIF">Nonaktif</option>
                            </select>
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