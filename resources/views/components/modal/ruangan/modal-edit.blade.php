<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Ruangan</h2>
            <form id="formEditRuangan" onsubmit="updateRuangan(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Ruangan</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editRuangan" class="block mb-1">Nama Ruangan</label>
                    <input type="text" id="editRuangan" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editGedung" class="block mb-1">Gedung Ruangan</label>
                    <input type="text" id="editGedung" name="gedung" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editLantai" class="block mb-1">Lantai Ruangan</label>
                    <input type="text" id="editLantai" name="lantai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editKapasitas" class="block mb-1">kapasitas Ruangan</label>
                    <input type="text" id="editKapasitas" name="kapasitas" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editJenis" class="block mb-1">Jenis Ruangan</label>
                    <select id="editJenis" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                                <option value="Kelas">Kelas</option>
                                <option value="Lab">Lab</option>
                                <option value="Aula">editMulai</option>
                                <option value="Seminar">Seminar</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editFasilitas" class="block mb-1">Fasilitas Ruangan</label>
                    <input type="text" id="editFasilitas" name="mulai" class="border p-2 w-full rounded" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>