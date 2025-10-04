const API_URL = "/graphql";
let currentPage = 1;

async function loadRoleData(page = 1) {
    currentPage = page;
    const perPage = parseInt(document.getElementById("perPage")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allRolePaginate(first: $first, page: $page, search: $search) {
            data { id nama_role deskripsi }
            paginatorInfo { currentPage lastPage total hasMorePages perPage }
        }
    }`;
    const variablesAktif = { first: perPage, page, search: searchValue };

    const resAktif = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ query: queryAktif, variables: variablesAktif })
    });
    const dataAktif = await resAktif.json();
    renderRoleTable(dataAktif?.data?.allRolePaginate?.data || [], 'dataRole', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allRoleArsip(first: $first, page: $page, search: $search) {
            data { id nama_role deskripsi }
            paginatorInfo { currentPage lastPage total hasMorePages perPage }
        }
    }`;
    const variablesArsip = { first: perPage, page, search: searchValue };

    const resArsip = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ query: queryArsip, variables: variablesArsip })
    });
    const dataArsip = await resArsip.json();
    renderRoleTable(dataArsip?.data?.allRoleArsip?.data || [], 'dataRoleArsip', false);

    // --- Update info pagination (untuk Data Aktif) ---
    const pageInfo = dataAktif?.data?.allRolePaginate?.paginatorInfo;
    if (pageInfo) {
        document.getElementById("pageInfo").innerText =
            `Halaman ${pageInfo.currentPage} dari ${pageInfo.lastPage} (Total: ${pageInfo.total})`;
        document.getElementById("prevBtn").disabled = pageInfo.currentPage <= 1;
        document.getElementById("nextBtn").disabled = !pageInfo.hasMorePages;
    }
}

function renderRoleTable(roles, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!roles.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    roles.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.nama_role}', '${item.deskripsi || ""}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusRole(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreRole(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteRole(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.nama_role}</td>
                <td class="border p-2">${item.deskripsi || "-"}</td>    
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusRole(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteRole(id: ${id}) { id }
    }`;
    await fetch(API_URL, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ query: mutation }) });
    loadRoleData(currentPage);
}

async function restoreRole(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreRole(id: ${id}) { id }
    }`;
    await fetch(API_URL, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ query: mutation }) });
    loadRoleData(currentPage);
}

async function forceDeleteRole(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteRole(id: ${id}) { id }
    }`;
    await fetch(API_URL, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ query: mutation }) });
    loadRoleData(currentPage);
}

// --- Search ---
async function searchRole() {
    const keyword = document.getElementById('search').value.trim();
    loadRoleData(1);
}
function prevPage() {
    if (currentPage > 1) loadRoleData(currentPage - 1);
}

function nextPage() {
    loadRoleData(currentPage + 1);
}

document.addEventListener("DOMContentLoaded", () => loadRoleData());
