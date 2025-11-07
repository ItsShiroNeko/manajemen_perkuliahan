const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadMataKuliahData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    // Ambil perPage dari select yang sesuai dengan tab aktif
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allMataKuliahPaginate(first: $first, page: $page, search: $search) {
            data { id kode_mk nama_mk jurusan{id nama_jurusan} sks semester_rekomendasi jenis deskripsi }
            paginatorInfo { currentPage lastPage total hasMorePages perPage }
        }
    }`;
    const variablesAktif = { first: perPageAktif, page: pageAktif, search: searchValue };

    const resAktif = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ query: queryAktif, variables: variablesAktif })
    });
    const dataAktif = await resAktif.json();
    renderMataKuliahTable(dataAktif?.data?.allMataKuliahPaginate?.data || [], 'dataMataKuliah', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allMataKuliahArsip(first: $first, page: $page, search: $search) {
            data { id kode_mk nama_mk jurusan{id nama_jurusan} sks semester_rekomendasi jenis deskripsi }
            paginatorInfo { currentPage lastPage total hasMorePages perPage }
        }
    }`;
    const variablesArsip = { first: perPageArsip, page: pageArsip, search: searchValue };

    const resArsip = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ query: queryArsip, variables: variablesArsip })
    });
    const dataArsip = await resArsip.json();
    renderMataKuliahTable(dataArsip?.data?.allMataKuliahArsip?.data || [], 'dataMataKuliahArsip', false);

    // --- Update info pagination untuk Data Aktif ---
    const pageInfoAktif = dataAktif?.data?.allMataKuliahPaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    // --- Update info pagination untuk Data Arsip ---
    const pageInfoArsip = dataArsip?.data?.allMataKuliahArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderMataKuliahTable(matakuliah, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!matakuliah.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    matakuliah.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.kode_mk}', '${item.nama_mk}', '${item.jurusan.id}', '${item.sks}', '${item.semester_rekomendasi}', '${item.jenis}', '${item.deskripsi}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusMataKuliah(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreMataKuliah(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteMataKuliah(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.kode_mk}</td>
                <td class="border p-2">${item.nama_mk}</td>    
                <td class="border p-2">${item.jurusan.nama_jurusan}</td>    
                <td class="border p-2">${item.sks}</td>    
                <td class="border p-2">${item.semester_rekomendasi}</td>    
                <td class="border p-2">${item.jenis}</td>   
                <td class="border p-2">${item.deskripsi}</td>   
                   
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusMataKuliah(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteMataKuliah(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMataKuliahData(currentPageAktif, currentPageArsip);
}

async function restoreMataKuliah(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreMataKuliah(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMataKuliahData(currentPageAktif, currentPageArsip);
}

async function forceDeleteMataKuliah(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteMataKuliah(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMataKuliahData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchMataKuliah() {
    loadMataKuliahData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadMataKuliahData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadMataKuliahData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadMataKuliahData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadMataKuliahData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadMataKuliahData());