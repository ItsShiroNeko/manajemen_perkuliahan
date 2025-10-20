<div id="modalEdit" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Krs</h2>
            <form id="formEditKrs" onsubmit="updateKrs(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editMahasiswaId" class="block mb-1">Mahasiswa</label>
                    <select id="editMahasiswaId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Mahasiswa</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editSemesterId" class="block mb-1">Semester</label>
                    <select id="editSemesterId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Semester</option> 
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editPengisian" class="block mb-1">Tanggal Pengisian</label>
                    <input type="date" id="editPengisian" name="tanggal pengisian" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editPersetujuan" class="block mb-1">Tanggal Persetujuan</label>
                    <input type="date" id="editPersetujuan" name="tanggal persetujuan" class="border p-2 w-full rounded"  >
                </div>
                <div class="mb-4">
                    <label for="editStatus" class="block mb-1">Status</label>
                    <select id="editStatus" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Status</option>
                                <option value="Draft">Draft</option>
                                <option value="Diajukan">Diajukan</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editTotalSks" class="block mb-1">Total SKS</label>
                    <input type="number" id="editTotalSks" name="total sks" class="border p-2 w-full rounded" step="0.01" required>
                </div>
                <div class="mb-4">
                    <label for="editCatatan" class="block mb-1">Catatan</label>
                    <textarea id="editCatatan" name="catatan" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="editDosenId" class="block mb-1">Dosen</label>
                    <select id="editDosenId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Dosen</option> 
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

