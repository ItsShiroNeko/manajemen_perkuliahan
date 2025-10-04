<x-layouts.dashboard title="Cek User">
<div class="bg-white p-4 rounded shadow w-full">
        <h1 class="text-2x1 font-bold mb-4">Data User</h1>

        <div class="flex justify-between mb-4">
            <input type="text" id="search" placeholder="Cari Id atau Nama..."
                class="border p-2 rounded w-64" oninput="searchUser()">
            <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Data</button>
        </div>
         <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">username</th>
                    <th class="p-2 border">email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody id="dataUser"></tbody>
         </table>
<div class="flex justify-between items-center mt-4">
    <div id="pageInfo" class="text-sm text-gray-600"></div>

    <div class="flex items-center gap-4">
        <select id="perPage"
            class="border p-2 rounded"
            onchange="loadDataPaginate(1)">
            <option value="5">5</option>
            <option value="10" selected>10</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <div class="flex gap-2">
            <button id="prevBtn" onclick="prevPage()"
                class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                Back
            </button>
            <button id="nextBtn" onclick="nextPage()"
                class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                Next
            </button>
        </div>
    </div>
</div>

    </div>
    @include('components.modal.user.modal-add')
    @include('components.modal.user.modal-edit')

    <script src="{{ asset('js/user/user.js') }}"></script>
    <script src="{{ asset('js/user/user-create.js') }}"></script>
    <script src="{{ asset('js/user/user-edit.js') }}"></script>
</x-layouts.dashboard>
