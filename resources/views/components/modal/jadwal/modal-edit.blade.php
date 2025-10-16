<div id="modalEdit" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Jadwal</h2>
            <form id="formEditJadwal" onsubmit="updateJadwal(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id"> 
                <div class="mb-4">
                    <label for="editKelasId" class="block mb-1">Kelas</label>
                    <select id="editKelasId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editRuanganId" class="block mb-1">Ruangan</label>
                    <select id="editRuanganId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editHari" class="block mb-1">Hari</label>
                    <select id="editHari" class="border p-2 w-full rounded" required>
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
                    <label for="editMulai" class="block mb-1">Jam Mulai</label>
                    <input type="time" id="editMulai" name="jam mulai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editSelesai" class="block mb-1">Jam Selesai</label>
                    <input type="time" id="editSelesai" name="jam selesai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editKeterangan" class="block mb-1">Keterangan</label>
                    <textarea id="editKeterangan" name="keterangan" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded">
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