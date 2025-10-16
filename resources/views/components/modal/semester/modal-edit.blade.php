<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Semester</h2>
            <form id="formEditSemester" onsubmit="updateSemester(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Semester</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editSemester" class="block mb-1">Nama Semester</label>
                    <input type="text" id="editSemester" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editTahun" class="block mb-1">Tahun Ajaran Semester</label>
                    <input type="text" id="editTahun" name="tahun" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editPeriode" class="block mb-1">Periode Semester</label>
                    <select id="editPeriode" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editMulai" class="block mb-1">Tanggal Mulai Semester</label>
                    <input type="text" id="editMulai" name="mulai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editSelesai" class="block mb-1">Tanggal Selesai Semester</label>
                    <input type="text" id="editSelesai" name="selesai" class="border p-2 w-full rounded" required>
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