<div id="modalEdit" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit MataKuliah</h2>
            <form id="formEditMataKuliah" onsubmit="updateMataKuliah(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Mata Kuliah</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editMataKuliah" class="block mb-1">Nama Mata Kuliah</label>
                    <input type="text" id="editMataKuliah" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editJurusanId" class="block mb-1">Jurusan Mata Kuliah</label>
                    <select id="editJurusanId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jurusan</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editSks" class="block mb-1">SKS</label>
                    <input type="number" id="editSks" name="sks" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editRekomendasi" class="block mb-1">Semester Rekomendasi</label>
                    <input type="number" id="editRekomendasi" name="rekomendasi" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editJenis" class="block mb-1">Jenis Mata Kuliah</label>
                    <select id="editJenis" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jenis Mata Kuliah</option>
                                <option value="Wajib">Wajib</option>
                                <option value="Pilihan">Pilihan</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editDeskripsi" class="block mb-1">Deskripsi Mata Kuliah</label>
                    <textarea id="editDeskripsi" name="deskripsi" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
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