<x-layouts.dashboard title="Data Semester">
    <div class="bg-white p-4 rounded shadow w-full">
        <h1 class="text-2x1 font-bold mb-4">Data Semester</h1>

        {{-- Search & Tambah Data --}}
        <div class="flex justify-between mb-4">
            <input type="text" id="search" placeholder="Cari ID atau Nama Semester..." class="border p-2 rounded w-64"
                oninput="searchSemester()">
            <button onclick="openAddModal()" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Data</button>
        </div>

        {{-- Tabs --}}
        <div class="mb-4">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-t" onclick="showTab('aktif')" id="tabAktif">Data Aktif</button>
            <button onclick="showTab('arsip')" id="tabArsip" class="px-4 py-2 bg-gray-300 text-black rounded-t">Data Arsip</button>
        </div>

        {{-- Table Aktif --}}
        <div id="tableAktif">
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Kode Semester</th>
                        <th class="p-2 border">Nama Semester</th>
                        <th class="p-2 border">Tahun Ajaran</th>
                        <th class="p-2 border">Periode</th>
                        <th class="p-2 border">Tanggal Mulai</th>
                        <th class="p-2 border">Tanggal Selesai</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataSemester"></tbody>
            </table>

            {{-- Pagination Data Aktif --}}
            <div class="flex justify-between items-center mt-4">
                <div id="pageInfoAktif" class="text-sm text-gray-600"></div>

                <div class="flex items-center gap-4">
                    <select id="perPage"
                        class="border p-2 rounded"
                        onchange="loadSemesterData(1, 1)">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <div class="flex gap-2">
                        <button id="prevBtnAktif" onclick="prevPageAktif()"
                            class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                            Back
                        </button>
                        <button id="nextBtnAktif" onclick="nextPageAktif()"
                            class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Arsip --}}
        <div id="tableArsip" class="hidden">
            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">Kode Semester</th>
                        <th class="p-2 border">Nama Semester</th>
                        <th class="p-2 border">Tahun Ajaran</th>
                        <th class="p-2 border">Periode</th>
                        <th class="p-2 border">Tanggal Mulai</th>
                        <th class="p-2 border">Tanggal Selesai</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataSemesterArsip"></tbody>
            </table>

            {{-- Pagination Data Arsip --}}
            <div class="flex justify-between items-center mt-4">
                <div id="pageInfoArsip" class="text-sm text-gray-600"></div>

                <div class="flex items-center gap-4">
                    <select id="perPageArsip"
                        class="border p-2 rounded"
                        onchange="loadSemesterData(1, 1)">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <div class="flex gap-2">
                        <button id="prevBtnArsip" onclick="prevPageArsip()"
                            class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                            Back
                        </button>
                        <button id="nextBtnArsip" onclick="nextPageArsip()"
                            class="bg-gray-300 px-3 py-1 rounded disabled:opacity-50">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        @include('components.modal.semester.modal-add')
        @include('components.modal.semester.modal-edit')

        {{-- Script --}}
        <script src="{{ asset('js/admin/semester/semester.js') }}"></script>
        <script src="{{ asset('js/admin/semester/semester-create.js') }}"></script>
        <script src="{{ asset('js/admin/semester/semester-edit.js') }}"></script>

        <script>
            function showTab(tab) {
                const tabAktif = document.getElementById('tabAktif');
                const tabArsip = document.getElementById('tabArsip');
                const tableAktif = document.getElementById('tableAktif');
                const tableArsip = document.getElementById('tableArsip');

                if (tab === 'aktif') {
                    tabAktif.classList.add('bg-blue-500', 'text-white');
                    tabAktif.classList.remove('bg-gray-300', 'text-black');
                    tabArsip.classList.remove('bg-blue-500', 'text-white');
                    tabArsip.classList.add('bg-gray-300', 'text-black');
                    tableAktif.classList.remove('hidden');
                    tableArsip.classList.add('hidden');
                } else {
                    tabArsip.classList.add('bg-blue-500', 'text-white');
                    tabArsip.classList.remove('bg-gray-300', 'text-black');
                    tabAktif.classList.remove('bg-blue-500', 'text-white');
                    tabAktif.classList.add('bg-gray-300', 'text-black');
                    tableArsip.classList.remove('hidden');
                    tableAktif.classList.add('hidden');
                }

                loadSemesterData(currentPageAktif, currentPageArsip);
            }
        </script>
    </div>
</x-layouts.dashboard>