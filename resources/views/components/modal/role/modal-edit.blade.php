<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit Role</h2>
            <form id="formEditBagian" onsubmit="updateRole(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="mb-4">
                    <label for="editRole" class="block mb-1">Nama Role</label>
                    <input type="text" id="editRole" name="nama" class="border p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editRoleDeskripsi" class="block mb-1">Deskripsi Role</label>
                    <textarea id="editRoleDeskripsi" name="deskripsi" id="" cols="10" rows="3" class="border p-1 w-full rounded" required></textarea>
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