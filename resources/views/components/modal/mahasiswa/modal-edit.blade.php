<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 m-4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Edit Data Mahasiswa</h2>
            <form id="formEditMahasiswa" onsubmit="updateMahasiswa(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                
                {{-- Data Akademik --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Akademik</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editNim" class="block mb-1 text-sm">NIM <span class="text-red-500">*</span></label>
                            <input type="text" id="editNim" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="editJurusanId" class="block mb-1 text-sm">Jurusan <span class="text-red-500">*</span></label>
                            <select id="editJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                        </div>
                        <div>
                            <label for="editAngkatan" class="block mb-1 text-sm">Angkatan <span class="text-red-500">*</span></label>
                            <input type="number" id="editAngkatan" class="border p-2 w-full rounded" required>
                        </div>
                        <div>
                            <label for="editStatus" class="block mb-1 text-sm">Status <span class="text-red-500">*</span></label>
                            <select id="editStatus" class="border p-2 w-full rounded" required>
                                <option value="AKTIF">Aktif</option>
                                <option value="CUTI">Cuti</option>
                                <option value="LULUS">Lulus</option>
                                <option value="DO">DO</option>
                            </select>
                        </div>
                        <div>
                            <label for="editSemester" class="block mb-1 text-sm">Semester Saat Ini <span class="text-red-500">*</span></label>
                            <input type="number" id="editSemester" class="border p-2 w-full rounded" required>
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

                {{-- Data Orang Tua --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Orang Tua</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editNamaAyah" class="block mb-1 text-sm">Nama Ayah</label>
                            <input type="text" id="editNamaAyah" class="border p-2 w-full rounded">
                        </div>
                        <div>
                            <label for="editNamaIbu" class="block mb-1 text-sm">Nama Ibu</label>
                            <input type="text" id="editNamaIbu" class="border p-2 w-full rounded">
                        </div>
                        <div class="col-span-2">
                            <label for="editNoHpOrtu" class="block mb-1 text-sm">No. HP Orang Tua</label>
                            <input type="text" id="editNoHpOrtu" class="border p-2 w-full rounded">
                        </div>
                    </div>
                </div>

                {{-- Data Akademik Lanjutan --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 border-b pb-2">Data Akademik Lanjutan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="editIpk" class="block mb-1 text-sm">IPK</label>
                            <input type="number" step="0.01" id="editIpk" class="border p-2 w-full rounded" placeholder="0.00">
                        </div>
                        <div>
                            <label for="editTotalSks" class="block mb-1 text-sm">Total SKS</label>
                            <input type="number" id="editTotalSks" class="border p-2 w-full rounded" placeholder="0">
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