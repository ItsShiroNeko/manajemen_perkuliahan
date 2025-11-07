const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadKrsData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    // Ambil perPage dari select yang sesuai dengan tab aktif
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allKrsPaginate(first: $first, page: $page, search: $search) {
            data { id mahasiswa{id nama_lengkap} semester{id nama_semester} tanggal_pengisian tanggal_persetujuan status total_sks catatan dosenPa{id nama_lengkap} }
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
    renderKrsTable(dataAktif?.data?.allKrsPaginate?.data || [], 'dataKrs', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allKrsArsip(first: $first, page: $page, search: $search) {
            data { id mahasiswa{id nama_lengkap} semester{id nama_semester} tanggal_pengisian tanggal_persetujuan status total_sks catatan dosenPa{id nama_lengkap} }
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
    renderKrsTable(dataArsip?.data?.allKrsArsip?.data || [], 'dataKrsArsip', false);

    // --- Update info pagination untuk Data Aktif ---
    const pageInfoAktif = dataAktif?.data?.allKrsPaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    // --- Update info pagination untuk Data Arsip ---
    const pageInfoArsip = dataArsip?.data?.allKrsArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderKrsTable(krs, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';
    if (!krs.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    krs.forEach(item => {
        console.log(krs)
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.mahasiswa.id}', '${item.semester.id}', '${item.tanggal_pengisian || ''}', '${item.tanggal_persetujuan || ''}', '${item.status}', '${item.total_sks}', '${item.catatan || '-'}', '${item.dosenPa.id}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusKrs(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreKrs(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteKrs(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.mahasiswa.nama_lengkap}</td>
                <td class="border p-2">${item.semester.nama_semester}</td>    
                <td class="border p-2">${item.tanggal_pengisian}</td>    
                <td class="border p-2">${item.tanggal_persetujuan || 'Pending'}</td>    
                <td class="border p-2">${item.status}</td>    
                <td class="border p-2">${item.total_sks}</td>
                <td class="border p-2">${item.catatan || '-'}</td>
                <td class="border p-2">${item.dosenPa.nama_lengkap}</td>
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusKrs(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteKrs(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadKrsData(currentPageAktif, currentPageArsip);
}

async function restoreKrs(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreKrs(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadKrsData(currentPageAktif, currentPageArsip);
}

async function forceDeleteKrs(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteKrs(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadKrsData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchKrs() {
    loadKrsData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadKrsData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadKrsData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadKrsData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadKrsData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadKrsData());