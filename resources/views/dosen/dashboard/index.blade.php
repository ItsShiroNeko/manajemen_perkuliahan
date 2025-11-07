<x-layouts.dashboard title="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Card 1 --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700">Jumlah Mahasiswa</h3>
                <i class="fas fa-users text-emerald-500 text-xl"></i>
            </div>
            <p class="mt-4 text-2xl font-bold text-gray-800">120</p>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700">Mata Kuliah</h3>
                <i class="fas fa-book text-sky-500 text-xl"></i>
            </div>
            <p class="mt-4 text-2xl font-bold text-gray-800">35</p>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700">Jadwal Aktif</h3>
                <i class="fas fa-calendar-alt text-emerald-400 text-xl"></i>
            </div>
            <p class="mt-4 text-2xl font-bold text-gray-800">12</p>
        </div>

    </div>
</x-layouts.dashboard>
