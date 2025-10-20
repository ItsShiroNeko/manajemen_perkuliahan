<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Krs</h2>
            <form id="formAddKrs" onsubmit="createKrs(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addMahasiswaId" class="block mb-1">Mahasiswa</label>
                    <select id="addMahasiswaId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Mahasiswa</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addSemesterId" class="block mb-1">Semester</label>
                    <select id="addSemesterId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Semester</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addPengisian" class="block mb-1">Tanggal Pengisian</label>
                    <input type="date" id="addPengisian" name="tanggal pengisian" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addStatus" class="block mb-1">Status</label>
                    <select id="addStatus" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Status</option>
                                <option value="Draft">Draft</option>
                                <option value="Diajukan">Diajukan</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addTotalSks" class="block mb-1">Total SKS</label>
                    <input type="number" id="addTotalSks" name="total sks" class="border p-2 w-full rounded" step="0.01" required>
                </div>
                <div class="mb-4">
                    <label for="addCatatan" class="block mb-1">Catatan</label>
                    <textarea id="addCatatan" name="catatan" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="addDosenId" class="block mb-1">Dosen</label>
                    <select id="addDosenId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Dosen</option> 
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