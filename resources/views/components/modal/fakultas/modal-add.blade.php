<!-- Modal Add -->
<div id="modalAdd" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Fakultas</h2>
            <form id="formAddFakultas" onsubmit="createFakultas(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addKode" class="block mb-1">Kode Fakultas</label>
                    <input type="text" id="addKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addFakultas" class="block mb-1">Nama Fakultas</label>
                    <input type="text" id="addFakultas" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addDekan" class="block mb-1">Dekan</label>
                    <input type="text" id="addDekan" name="dekan" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addAlamat" class="block mb-1">Alamat</label>
                    <textarea id="addAlamat" name="alamat" rows="2" class="border p-2 w-full rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="addTelepon" class="block mb-1">Nomer Telepon</label>
                    <input type="text" id="addTelepon" name="telepon" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addEmail" class="block mb-1">Email</label>
                    <input type="email" id="addEmail" name="email" class="border p-2 w-full rounded" required>
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
