<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Khs</h2>
            <form id="formAddKhs" onsubmit="createKhs(); return false;">
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
                    <label for="addSksSemester" class="block mb-1">SKS semester</label>
                    <input type="number" id="addSksSemester" name="sks semester" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addSksKumulatif" class="block mb-1">SKS kumulatif</label>
                    <input type="number" id="addSksKumulatif" name="sks semester" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addIpSemester" class="block mb-1">IP semester</label>
                    <input type="number" id="addIpSemester" name="ip semester" class="border p-2 w-full rounded" step="0.01" required>
                </div>
                <div class="mb-4">
                    <label for="addIPK" class="block mb-1">IPK</label>
                    <input type="number" id="addIPK" name="ipk" class="border p-2 w-full rounded" step="0.01" required>
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