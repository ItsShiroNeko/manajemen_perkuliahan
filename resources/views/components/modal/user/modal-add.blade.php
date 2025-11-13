<div id="modalAdd" class="hidden">
    <div class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Tambah User</h2>

            <form id="formAddUser" onsubmit="createUser(); return false;">
                @csrf
                <div class="mb-4">
                    <label for="addUsername" class="block mb-1 font-medium">Nama Username</label>
                    <input type="text" id="addUsername" name="username" class="border p-2 w-full rounded" required>
                </div>

                <div class="mb-4">
                    <label for="addEmail" class="block mb-1 font-medium">Alamat Email</label>
                    <input type="email" id="addEmail" name="email" class="border p-2 w-full rounded" required>
                </div>

                <div class="mb-4">
                    <label for="addPassword" class="block mb-1 font-medium">Password</label>
                    <input type="password" id="addPassword" name="password" class="border p-2 w-full rounded" required>
                </div>

                <div class="mb-4">
                    <label for="addRole" class="block mb-1 font-medium">Role</label>
                    <select id="addRole" name="role_id" class="border p-2 w-full rounded" required>
                        <option value="">Memuat data role...</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="addStatus" class="block mb-1 font-medium">Status</label>
                    <select id="addStatus" name="status" class="border p-2 w-full rounded" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-4">
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