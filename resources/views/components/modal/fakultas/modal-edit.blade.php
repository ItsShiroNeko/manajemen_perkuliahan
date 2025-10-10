<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Fakultas</h2>
            <form id="formEditFakultas" onsubmit="updateFakultas(); return false;">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editKode" class="block mb-1">Kode Fakultas</label>
                    <input type="text" id="editKode" name="kode" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editFakultas" class="block mb-1">Nama Fakultas</label>
                    <input type="text" id="editFakultas" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editDekan" class="block mb-1">Dekan</label>
                    <input type="text" id="editDekan" name="dekan" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editAlamat" class="block mb-1">Alamat</label>
                    <textarea id="editAlamat" name="alamat" rows="2" class="border p-2 w-full rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="editTelepon" class="block mb-1">Nomer Telepon</label>
                    <input type="text" id="editTelepon" name="telepon" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editEmail" class="block mb-1">Email</label>
                    <input type="email" id="editEmail" name="email" class="border p-2 w-full rounded" required>
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