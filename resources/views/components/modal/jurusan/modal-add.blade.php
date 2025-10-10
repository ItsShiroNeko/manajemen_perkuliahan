<!-- Modal Add -->
<div id="modalAdd" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Jurusan</h2>
            <form id="formAddJurusan" onsubmit="createJurusan(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Jurusan</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addNama" class="block mb-1">Nama Jurusan</label>
                    <input type="text" id="addNama" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addJenjang" class="block mb-1">Jenjang</label>
                    <select id="addJenjang" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                </div>
                <div class="mb-4">
                <label for="addFakultasId" class="block mb-1 text-sm">Fakultas <span class="text-red-500">*</span></label>
                            <select id="addFakultasId" class="border p-2 w-full rounded" required>
                                <option value="">Pilih Fakultas</option>
                                <!-- Options akan diisi via JS -->
                            </select>
                </div>
                <div class="mb-4">
                    <label for="addAkreditasi" class="block mb-1">Nomer Akreditasi</label>
                    <select id="addAkreditasi" class="border p-2 w-full rounded" required>
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
                    <label for="addKaprodi" class="block mb-1">Kaprodi</label>
                    <input type="text" id="addKaprodi" name="kaprodi" class="border p-2 w-full rounded" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
