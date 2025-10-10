const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadFakultasData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allFakultasPaginate(first: $first, page: $page, search: $search) {
            data { id kode_fakultas nama_fakultas dekan alamat telepon email }
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
    renderRoleTable(dataAktif?.data?.allFakultasPaginate?.data || [], 'dataFakultas', true);

    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allFakultasArsip(first: $first, page: $page, search: $search) {
            data { id kode_fakultas nama_fakultas dekan alamat telepon email }
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
    renderRoleTable(dataArsip?.data?.allFakultasArsip?.data || [], 'dataFakultasArsip', false);

    const pageInfoAktif = dataAktif?.data?.allRolePaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    const pageInfoArsip = dataArsip?.data?.allFakultasArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderRoleTable(fakultas, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!fakultas.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    fakultas.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.kode_fakultas}', '${item.nama_fakultas}', '${item.dekan}', '${item.alamat}','${item.telepon}','${item.email}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusFakultas(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreFakultas(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteFakultas(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.kode_fakultas || "-"}</td>   
                <td class="border p-2">${item.nama_fakultas || "-"}</td>   
                <td class="border p-2">${item.dekan || "-"}</td>   
                <td class="border p-2">${item.alamat || "-"}</td>   
                <td class="border p-2">${item.telepon || "-"}</td>   
                <td class="border p-2">${item.email || "-"}</td>   
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusFakultas(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteFakultas(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadFakultasData(currentPageAktif, currentPageArsip);
}

async function restoreFakultas(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreFakultas(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadFakultasData(currentPageAktif, currentPageArsip);
}

async function forceDeleteFakultas(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteFakultas(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadFakultasData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchFakultas() {
    loadFakultasData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadFakultasData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadFakultasData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadFakultasData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadFakultasData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadFakultasData());