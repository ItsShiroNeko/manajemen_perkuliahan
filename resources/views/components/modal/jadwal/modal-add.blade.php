<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Jadwal</h2>
            <form id="formAddJadwal" onsubmit="createJadwal(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKelasId" class="block mb-1">Kelas</label>
                    <select id="addKelasId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addRuanganId" class="block mb-1">Ruangan</label>
                    <select id="addRuanganId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addHari" class="block mb-1">Hari</label>
                    <select id="addHari" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Kamis">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addMulai" class="block mb-1">Jam Mulai</label>
                    <input type="time" id="addMulai" name="jam mulai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addSelesai" class="block mb-1">Jam Selesai</label>
                    <input type="time" id="addSelesai" name="jam selesai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addKeterangan" class="block mb-1">Keterangan</label>
                    <textarea id="addKeterangan" name="keterangan" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>