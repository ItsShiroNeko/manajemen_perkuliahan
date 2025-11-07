const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadMahasiswaData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    // Ambil perPage dari select yang sesuai dengan tab aktif
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allMahasiswaPaginate(first: $first, page: $page, search: $search) {
            data { 
                id 
                nim 
                nama_lengkap 
                jurusan {
                    id
                    nama_jurusan
                }
                angkatan 
                jenis_kelamin 
                status 
                semester_saat_ini 
                ipk 
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
    renderMahasiswaTable(dataAktif?.data?.allMahasiswaPaginate?.data || [], 'dataMahasiswa', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allMahasiswaArsip(first: $first, page: $page, search: $search) {
            data { 
                id 
                nim 
                nama_lengkap 
                jurusan {
                    id
                    nama_jurusan
                }
                angkatan 
                jenis_kelamin 
                status 
                semester_saat_ini 
                ipk 
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
    renderMahasiswaTable(dataArsip?.data?.allMahasiswaArsip?.data || [], 'dataMahasiswaArsip', false);

    const pageInfoAktif = dataAktif?.data?.allMahasiswaPaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    // --- Update info pagination untuk Data Arsip ---
    const pageInfoArsip = dataArsip?.data?.allMahasiswaArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderMahasiswaTable(mahasiswa, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!mahasiswa.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="10" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    mahasiswa.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <a href="/admin/mahasiswa_detail/${item.id}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm inline-block">Detail</a>
                <button onclick="openEditModal(${item.id})" class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Edit</button>
                <button onclick="hapusMahasiswa(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded text-sm">Arsipkan</button>
            `;
        } else {
            actions = `
                <a href="/mahasiswa_detail/${item.id}" class="bg-blue-500 text-white px-2 py-1 rounded text-sm inline-block">Detail</a>
                <button onclick="restoreMahasiswa(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded text-sm">Restore</button>
                <button onclick="forceDeleteMahasiswa(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded text-sm">Hapus Permanen</button>
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
            case 'LULUS':
                statusBadge = '<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">Lulus</span>';
                break;
            case 'DO':
                statusBadge = '<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">DO</span>';
                break;
            default:
                statusBadge = `<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">${item.status || '-'}</span>`;
        }

        tbody.innerHTML += `
            <tr class="hover:bg-gray-50">
                <td class="border p-2 text-sm">${item.nim}</td>
                <td class="border p-2 text-sm">${item.nama_lengkap}</td>
                <td class="border p-2 text-sm">${item.jurusan?.nama_jurusan || "-"}</td>    
                <td class="border p-2 text-sm text-center">${item.angkatan}</td>
                <td class="border p-2 text-sm text-center">${item.jenis_kelamin}</td>
                <td class="border p-2 text-sm text-center">${statusBadge}</td>
                <td class="border p-2 text-sm text-center">${item.semester_saat_ini}</td>
                <td class="border p-2 text-sm text-center">${item.ipk ? item.ipk.toFixed(2) : '-'}</td>
                <td class="border p-2 text-sm">${item.no_hp || "-"}</td>
                <td class="border p-2 text-sm whitespace-nowrap">${actions}</td>
            </tr>
        `;
    });
}

async function hapusMahasiswa(id) {
    if (!confirm('Pindahkan mahasiswa ini ke arsip?')) return;
    const mutation = `
    mutation {
        deleteMahasiswa(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMahasiswaData(currentPageAktif, currentPageArsip);
}

async function restoreMahasiswa(id) {
    if (!confirm('Kembalikan mahasiswa ini dari arsip?')) return;
    const mutation = `
    mutation {
        restoreMahasiswa(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMahasiswaData(currentPageAktif, currentPageArsip);
}

async function forceDeleteMahasiswa(id) {
    if (!confirm('PERINGATAN: Hapus permanen? Data tidak bisa dikembalikan!')) return;
    const mutation = `
    mutation {
        forceDeleteMahasiswa(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadMahasiswaData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchMahasiswa() {
    loadMahasiswaData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadMahasiswaData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadMahasiswaData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadMahasiswaData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadMahasiswaData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadMahasiswaData());