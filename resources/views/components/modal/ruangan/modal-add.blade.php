<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Ruangan</h2>
            <form id="formAddRuangan" onsubmit="createRuangan(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Ruangan</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addRuangan" class="block mb-1">Nama Ruangan</label>
                    <input type="text" id="addRuangan" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addGedung" class="block mb-1">Gedung Ruangan</label>
                    <input type="text" id="addGedung" name="gedung" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addLantai" class="block mb-1">Lantai Ruangan</label>
                    <input type="number" id="addLantai" name="lantai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addKapasitas" class="block mb-1">kapasitas Ruangan</label>
                    <input type="number" id="addKapasitas" name="kapasitas" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addJenis" class="block mb-1">Jenis Ruangan</label>
                    <select id="addJenis" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                                <option value="Kelas">Kelas</option>
                                <option value="Lab">Lab</option>
                                <option value="Aula">addMulai</option>
                                <option value="Seminar">Seminar</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addFasilitas" class="block mb-1">Fasilitas Ruangan</label>
                    <input type="text" id="addFasilitas" name="mulai" class="border p-2 w-full rounded" required>
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