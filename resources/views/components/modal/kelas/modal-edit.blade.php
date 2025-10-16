<div id="modalEdit" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Kelas</h2>
            <form id="formEditKelas" onsubmit="updateKelas(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Kelas</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editKelas" class="block mb-1">Nama Kelas</label>
                    <input type="text" id="editKelas" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editMataKuliahId" class="block mb-1">Mata Kuliah</label>
                    <select id="editMataKuliahId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Mata Kuliah</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editDosenId" class="block mb-1">Dosen</label>
                    <select id="editDosenId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Dosen</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editSemesterId" class="block mb-1">Semester</label>
                    <select id="editSemesterId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Semester</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editKapasitas" class="block mb-1">Kapasitas</label>
                    <input type="number" id="editKapasitas" name="kapasitas" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editStatus" class="block mb-1">Status Kelas</label>
                    <select id="editStatus" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Status Kelas</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
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