<div id="modalEdit" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Khs</h2>
            <form id="formEditKhs" onsubmit="updateKhs(); return false;">
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
                    <label for="editSksSemester" class="block mb-1">SKS semester</label>
                    <input type="number" id="editSksSemester" name="sks semester" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editSksKumulatif" class="block mb-1">SKS kumulatif</label>
                    <input type="number" id="editSksKumulatif" name="sks semester" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editIpSemester" class="block mb-1">IP semester</label>
                    <input type="number" id="editIpSemester" name="ip semester" class="border p-2 w-full rounded" step="0.01" required>
                </div>
                <div class="mb-4">  
                    <label for="editIPK" class="block mb-1">IPK</label>
                    <input type="number" id="editIPK" name="ipk" class="border p-2 w-full rounded" step="0.01" required>
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