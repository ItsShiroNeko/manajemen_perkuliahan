<div id="modalAdd" class="hidden">
<div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah Role</h2>
            <form id="formAddRole" onsubmit="createRole(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addRole" class="block mb-1">Nama Role</label>
                    <input type="text" id="addRole" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addRoleDeskripsi" class="block mb-1">Deskripsi Role</label>
                    <textarea id="addRoleDeskripsi" name="deskripsi" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
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