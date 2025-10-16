<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Semester</h2>
            <form id="formAddSemester" onsubmit="createSemester(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Semester</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addSemester" class="block mb-1">Nama Semester</label>
                    <input type="text" id="addSemester" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addTahun" class="block mb-1">Tahun Ajaran</label>
                    <input type="text" id="addTahun" name="tahun" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addPeriode" class="block mb-1">Periode</label>
                    <select id="addPeriode" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Periode</option>
                                <option value="Genap">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addMulai" class="block mb-1">Tanggal Mulai</label>
                    <input type="date" id="addMulai" name="mulai" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addSelesai" class="block mb-1">Tanggal Selesai</label>
                    <input type="date" id="addSelesai" name="selesai" class="border p-2 w-full rounded" required>
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