const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadDosenData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allDosenPaginate(first: $first, page: $page, search: $search) {
            data { 
                id 
                nidn 
                nip
                nama_lengkap
                gelar_depan
                gelar_belakang
                jurusan {
                    id
                    nama_jurusan
                }
                jenis_kelamin
                status_kepegawaian
                jabatan
                status
                no_hp
            }
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
    renderDosenTable(dataAktif?.data?.allDosenPaginate?.data || [], 'dataDosen', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allDosenArsip(first: $first, page: $page, search: $search) {
            data { 
                id 
                nidn 
                nip
                nama_lengkap
                gelar_depan
                gelar_belakang
                jurusan {
                    id
                    nama_jurusan
                }
                jenis_kelamin
                status_kepegawaian
                jabatan
                status
                no_hp
            }
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
    renderDosenTable(dataArsip?.data?.allDosenArsip?.data || [], 'dosenArsip', false);

    // --- Update info pagination untuk Data Aktif ---
    const pageInfoAktif = dataAktif?.data?.allDosenPaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    // --- Update info pagination untuk Data Arsip ---
    const pageInfoArsip = dataArsip?.data?.allDosenArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderDosenTable(dosen, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!dosen.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="11" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    dosen.forEach(item => {
        // Format nama dengan gelar
        let namaLengkap = item.nama_lengkap;
        if (item.gelar_depan || item.gelar_belakang) {
            namaLengkap = `${item.gelar_depan || ''} ${item.nama_lengkap} ${item.gelar_belakang || ''}`.trim();
        }

        let actions = '';
        if (isActive) {
            actions = `
                <a href="/dosen_detail/${item.id}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm inline-block">Detail</a>
                <button onclick="openEditModal(${item.id})" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</button>
                <button onclick="hapusDosen(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Arsipkan</button>
            `;
        } else {
            actions = `
                <a href="/dosen_detail/${item.id}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm inline-block">Detail</a>
                <button onclick="restoreDosen(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Restore</button>
                <button onclick="forceDeleteDosen(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded text-sm">Hapus Permanen</button>
            `;
        }

        // Badge untuk status
        let statusBadge = '';
        switch(item.status?.toUpperCase()) {
            case 'AKTIF':
                statusBadge = '<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Aktif</span>';
                break;
            case 'CUTI':
                statusBadge = '<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Cuti</span>';
                break;
            case 'PENSIUN':
                statusBadge = '<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Pensiun</span>';
                break;
            case 'NONAKTIF':
                statusBadge = '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Nonaktif</span>';
                break;
            default:
                statusBadge = `<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">${item.status || '-'}</span>`;
        }

        tbody.innerHTML += `
            <tr class="hover:bg-gray-50">
                <td class="border p-2 text-sm">${item.nidn}</td>
                <td class="border p-2 text-sm">${item.nip || "-"}</td>
                <td class="border p-2 text-sm">${namaLengkap}</td>
                <td class="border p-2 text-sm">${item.gelar_depan || ''} / ${item.gelar_belakang || '-'}</td>
                <td class="border p-2 text-sm">${item.jurusan?.nama_jurusan || "-"}</td>    
                <td class="border p-2 text-sm text-center">${item.jenis_kelamin}</td>
                <td class="border p-2 text-sm">${item.status_kepegawaian || "-"}</td>
                <td class="border p-2 text-sm">${item.jabatan || "-"}</td>
                <td class="border p-2 text-sm text-center">${statusBadge}</td>
                <td class="border p-2 text-sm">${item.no_hp || "-"}</td>
                <td class="border p-2 text-sm whitespace-nowrap">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusDosen(id) {
    if (!confirm('Pindahkan dosen ini ke arsip?')) return;
    const mutation = `
    mutation {
        deleteDosen(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadDosenData(currentPageAktif, currentPageArsip);
}

async function restoreDosen(id) {
    if (!confirm('Kembalikan dosen ini dari arsip?')) return;
    const mutation = `
    mutation {
        restoreDosen(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadDosenData(currentPageAktif, currentPageArsip);
}

async function forceDeleteDosen(id) {
    if (!confirm('PERINGATAN: Hapus permanen? Data tidak bisa dikembalikan!')) return;
    const mutation = `
    mutation {
        forceDeleteDosen(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadDosenData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchDosen() {
    loadDosenData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadDosenData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadDosenData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadDosenData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadDosenData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadDosenData());