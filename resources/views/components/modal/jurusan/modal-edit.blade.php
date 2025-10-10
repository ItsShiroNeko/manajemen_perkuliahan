<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Jurusan</h2>
            <form id="formEditJurusan" onsubmit="updateJurusan(); return false;">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Jurusan</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editNama" class="block mb-1">Nama Jurusan</label>
                    <input type="text" id="editNama" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                <label for="editFakultasId" class="block mb-1 text-sm">Fakultas <span class="text-red-500">*</span></label>
                            <select id="editFakultasId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Fakultas</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editJenjang" class="block mb-1">Jenjang</label>
                    <select id="editJenjang" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editAkreditasi" class="block mb-1">Akreditasi</label>
                    <select id="editAkreditasi" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Akreditasi</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="Unggul">Unggul</option>
                                <option value="Baik Sekali">Baik Sekali</option>
                                <option value="Baik">Baik</option>
                            </select>
                </div>
                <div class="mb-4">
                    <label for="editKaprodi" class="block mb-1">Kaprodi</label>
                    <input type="text" id="editKaprodi" name="kaprodi" class="border p-2 w-full rounded" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>