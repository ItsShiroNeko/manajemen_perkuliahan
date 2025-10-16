<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah MataKuliah</h2>
            <form id="formAddMataKuliah" onsubmit="createMataKuliah(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Mata Kuliah</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addMataKuliah" class="block mb-1">Nama Mata Kuliah</label>
                    <input type="text" id="addMataKuliah" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addJurusanId" class="block mb-1">Jurusan Mata Kuliah</label>
                    <select id="addJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addSks" class="block mb-1">SKS</label>
                    <input type="number" id="addSks" name="sks" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addRekomendasi" class="block mb-1">Semester Rekomendasi</label>
                    <input type="number" id="addRekomendasi" name="rekomendasi" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addJenis" class="block mb-1">Jenis Mata Kuliah</label>
                    <select id="addJenis" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jenis Mata Kuliah</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Pilihan">Pilihan</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addDeskripsi" class="block mb-1">Deskripsi Mata Kuliah</label>
                    <textarea id="addDeskripsi" name="deskripsi" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
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