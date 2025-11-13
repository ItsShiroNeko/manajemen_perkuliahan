<!-- Modal Edit User -->
<div id="modalEdit" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Edit User</h2>

            <form id="formEditUser" onsubmit="updateUser(); return false;">
                @csrf
                <input type="hidden" id="editId" name="id">

                <div class="mb-4">
                    <label for="editUsername" class="block mb-1 font-medium">Nama Username</label>
                    <input type="text" id="editUsername" name="username" class="border p-2 w-full rounded" required>
                </div>

                <div class="mb-4">
                    <label for="editEmail" class="block mb-1 font-medium">Alamat Email</label>
                    <input type="email" id="editEmail" name="email" class="border p-2 w-full rounded" required>
                </div>

                <div class="mb-4">
                    <label for="editRole" class="block mb-1 font-medium">Role</label>
                    <select id="editRole" name="role_id" class="border p-2 w-full rounded" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="1">Admin</option>
                        <option value="2">Dosen</option>
                        <option value="3">Mahasiswa</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="editStatus" class="block mb-1 font-medium">Status</label>
                    <select id="editStatus" name="status" class="border p-2 w-full rounded" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-4">
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
