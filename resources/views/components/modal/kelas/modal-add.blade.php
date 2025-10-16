<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Kelas</h2>
            <form id="formAddKelas" onsubmit="createKelas(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Mata Kuliah</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addKelas" class="block mb-1">Nama Kelas</label>
                    <input type="text" id="addKelas" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addMataKuliahId" class="block mb-1">Mata Kuliah</label>
                    <select id="addMataKuliahId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Mata Kuliah</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addDosenId" class="block mb-1">Dosen</label>
                    <select id="addDosenId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Dosen</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addSemesterId" class="block mb-1">Semester</label>
                    <select id="addSemesterId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Semester</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addKapasitas" class="block mb-1">Kapasitas</label>
                    <input type="number" id="addKapasitas" name="kapasitas" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4    ">
                    <label for="addStatus" class="block mb-1">Status Kelas</label>
                    <select id="addStatus" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Status Kelas</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                                <option value="Selesai">Selesai</option>
                            </select>
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