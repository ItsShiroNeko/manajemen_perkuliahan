<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 m-4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Edit Data Dosen</h2>
            <form id="formEditDosen" onsubmit="updateDosen(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                
                {{-- Data Identitas --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Identitas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editNidn" class="block mb-1 text-sm">NIDN <span class="text-red-500">*</span></label>
                            <input type="text" id="editNidn" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="editNip" class="block mb-1 text-sm">NIP</label>
                            <input type="text" id="editNip" class="border p-2 w-full rounded">
                        </div>
                        <div>
                            <label for="editUserId" class="block mb-1 text-sm">User ID <span class="text-red-500">*</span></label>
                            <input type="number" id="editUserId" class="border p-2 w-full rounded" required>
                        </div>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Pribadi</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editGelarDepan" class="block mb-1 text-sm">Gelar Depan</label>
                            <input type="text" id="editGelarDepan" class="border p-2 w-full rounded" placeholder="Dr., Prof., dll">
                        </div>
                        <div>
                            <label for="editGelarBelakang" class="block mb-1 text-sm">Gelar Belakang</label>
                            <input type="text" id="editGelarBelakang" class="border p-2 w-full rounded" placeholder="S.Kom., M.T., Ph.D., dll">
                        </div>
                        <div class="col-span-2">
                            <label for="editNamaLengkap" class="block mb-1 text-sm">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="editNamaLengkap" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="editJenisKelamin" class="block mb-1 text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select id="editJenisKelamin" class="border p-2 w-full rounded" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="editTanggalLahir" class="block mb-1 text-sm">Tanggal Lahir</label>
                            <input type="date" id="editTanggalLahir" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="editTempatLahir" class="block mb-1 text-sm">Tempat Lahir</label>
                            <input type="text" id="editTempatLahir" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="editAlamat" class="block mb-1 text-sm">Alamat</label>
                            <textarea id="editAlamat" rows="2" class="border p-2 w-full rounded"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Data Kepegawaian --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Kepegawaian</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editJurusanId" class="block mb-1 text-sm">Jurusan <span class="text-red-500">*</span></label>
                            <select id="editJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                        </div>
                        <div>
                            <label for="editStatusKepegawaian" class="block mb-1 text-sm">Status Kepegawaian <span class="text-red-500">*</span></label>
                            <select id="editStatusKepegawaian" class="border p-2 w-full rounded" required>
                                <option value="">Pilih</option>
                                <option value="PNS">PNS</option>
                                <option value="CPNS">CPNS</option>
                                <option value="HONORER">Honorer</option>
                                <option value="KONTRAK">Kontrak</option>
                                <option value="TETAP">Tetap</option>
                            </select>
                        </div>
                        <div>
                            <label for="editJabatan" class="block mb-1 text-sm">Jabatan</label>
                            <input type="text" id="editJabatan" class="border p-2 w-full rounded" placeholder="Dosen, Lektor, dll">
                        </div>
                        <div>
                            <label for="editStatus" class="block mb-1 text-sm">Status <span class="text-red-500">*</span></label>
                            <select id="editStatus" class="border p-2 w-full rounded" required>
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
                            <label for="editNoHp" class="block mb-1 text-sm">No. HP</label>
                            <input type="text" id="editNoHp" class="border p-2 w-full rounded">
                        </div>
                        <div>
                            <label for="editEmailPribadi" class="block mb-1 text-sm">Email Pribadi</label>
                            <input type="email" id="editEmailPribadi" class="border p-2 w-full rounded">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>