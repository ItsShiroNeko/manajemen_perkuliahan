const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadJurusanData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allJurusanPaginate(first: $first, page: $page, search: $search) {
            data { id kode_jurusan nama_jurusan fakultas{id nama_fakultas} jenjang akreditasi kaprodi }
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
    renderRoleTable(dataAktif?.data?.allJurusanPaginate?.data || [], 'dataJurusan', true);

    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allJurusanArsip(first: $first, page: $page, search: $search) {
            data { id kode_jurusan nama_jurusan fakultas{id nama_fakultas} jenjang akreditasi kaprodi }
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
    renderRoleTable(dataArsip?.data?.allJurusanArsip?.data || [], 'dataJurusanArsip', false);

    const pageInfoAktif = dataAktif?.data?.allRolePaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    const pageInfoArsip = dataArsip?.data?.allJurusanArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderRoleTable(jurusan, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!jurusan.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    jurusan.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.kode_jurusan}', '${item.nama_jurusan}', '${item.fakultas.id}', '${item.jenjang}','${item.akreditasi}','${item.kaprodi}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusJurusan(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreJurusan(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteJurusan(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.kode_jurusan || "-"}</td>   
                <td class="border p-2">${item.nama_jurusan || "-"}</td>   
                <td class="border p-2">${item.fakultas?.nama_fakultas || "-"}</td>   
                <td class="border p-2">${item.jenjang || "-"}</td>   
                <td class="border p-2">${item.akreditasi || "-"}</td>   
                <td class="border p-2">${item.kaprodi || "-"}</td>   
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusJurusan(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteJurusan(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadJurusanData(currentPageAktif, currentPageArsip);
}

async function restoreJurusan(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreJurusan(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadJurusanData(currentPageAktif, currentPageArsip);
}

async function forceDeleteJurusan(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteJurusan(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadJurusanData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchJurusan() {
    loadJurusanData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadJurusanData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadJurusanData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadJurusanData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadJurusanData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadJurusanData());