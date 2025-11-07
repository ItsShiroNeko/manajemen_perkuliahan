const API_URL = "/graphql";
let currentPageAktif = 1;
let currentPageArsip = 1;

async function loadNilaiData(pageAktif = 1, pageArsip = 1) {
    currentPageAktif = pageAktif;
    currentPageArsip = pageArsip;
    
    // Ambil perPage dari select yang sesuai dengan tab aktif
    const perPageAktif = parseInt(document.getElementById("perPage")?.value || 10);
    const perPageArsip = parseInt(document.getElementById("perPageArsip")?.value || 10);
    const searchValue = document.getElementById("search")?.value.trim() || "";

    // --- Query Data Aktif ---
    const queryAktif = `
    query($first: Int, $page: Int, $search: String) {
        allNilaiPaginate(first: $first, page: $page, search: $search) {
            data { id krsDetail{krs{mahasiswa{nama_lengkap}}mataKuliah{nama_mk}} tugas quiz uts uas nilai_akhir nilai_huruf nilai_mutu status }
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
    renderNilaiTable(dataAktif?.data?.allNilaiPaginate?.data || [], 'dataNilai', true);

    // --- Query Data Arsip ---
    const queryArsip = `
    query($first: Int, $page: Int, $search: String) {
        allNilaiArsip(first: $first, page: $page, search: $search) {
            data { id krsDetail{krs{mahasiswa{nama_lengkap}}mataKuliah{nama_mk}} tugas quiz uts uas nilai_akhir nilai_huruf nilai_mutu status }
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
    renderNilaiTable(dataArsip?.data?.allNilaiArsip?.data || [], 'dataNilaiArsip', false);

    // --- Update info pagination untuk Data Aktif ---
    const pageInfoAktif = dataAktif?.data?.allNilaiPaginate?.paginatorInfo;
    if (pageInfoAktif) {
        document.getElementById("pageInfoAktif").innerText =
            `Halaman ${pageInfoAktif.currentPage} dari ${pageInfoAktif.lastPage} (Total: ${pageInfoAktif.total})`;
        document.getElementById("prevBtnAktif").disabled = pageInfoAktif.currentPage <= 1;
        document.getElementById("nextBtnAktif").disabled = !pageInfoAktif.hasMorePages;
    }

    // --- Update info pagination untuk Data Arsip ---
    const pageInfoArsip = dataArsip?.data?.allNilaiArsip?.paginatorInfo;
    if (pageInfoArsip) {
        document.getElementById("pageInfoArsip").innerText =
            `Halaman ${pageInfoArsip.currentPage} dari ${pageInfoArsip.lastPage} (Total: ${pageInfoArsip.total})`;
        document.getElementById("prevBtnArsip").disabled = pageInfoArsip.currentPage <= 1;
        document.getElementById("nextBtnArsip").disabled = !pageInfoArsip.hasMorePages;
    }
}

function renderNilaiTable(Nilai, tableId, isActive) {
    const tbody = document.getElementById(tableId);
    tbody.innerHTML = '';

    if (!Nilai.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">Tidak ada data</td>
            </tr>
        `;
        return;
    }

    Nilai.forEach(item => {
        let actions = '';
        if (isActive) {
            actions = `
                <button onclick="openEditModal(${item.id}, '${item.krsDetail.krs.mahasiswa.nama_lengkap}', '${item.krsDetail.mataKuliah.nama_mk}', '${item.tugas}', '${item.quiz}', '${item.uts}', '${item.uas}', '${item.nilai_akhir}, '${item.nilai_huruf}, '${item.nilai_mutu}, '${item.status}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                <button onclick="hapusNilai(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Arsipkan</button>
            `;
        } else {
            actions = `
                <button onclick="restoreNilai(${item.id})" class="bg-green-500 text-white px-2 py-1 rounded">Restore</button>
                <button onclick="forceDeleteNilai(${item.id})" class="bg-red-700 text-white px-2 py-1 rounded">Hapus Permanen</button>
            `;
        }

        tbody.innerHTML += `
            <tr>
                <td class="border p-2">${item.id}</td>
                <td class="border p-2">${item.krsDetail.krs.mahasiswa.nama_lengkap}</td>
                <td class="border p-2">${item.krsDetail.mataKuliah.nama_mk}</td>    
                <td class="border p-2">${item.tugas || '-'}</td>    
                <td class="border p-2">${item.quiz || '-'}</td>    
                <td class="border p-2">${item.uts || '-'}</td>    
                <td class="border p-2">${item.uas || '-'}</td>   
                <td class="border p-2">${item.nilai_akhir || '-'}</td>   
                <td class="border p-2">${item.nilai_huruf || '-'}</td>   
                <td class="border p-2">${item.nilai_mutu || '-'}</td>   
                <td class="border p-2">${item.status || '-'}</td>   
                   
                <td class="border p-2">${actions}</td>
            </tr>
        `;
    });
}

// --- Mutations ---
async function hapusNilai(id) {
    if (!confirm('Pindahkan ke arsip?')) return;
    const mutation = `
    mutation {
        deleteNilai(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadNilaiData(currentPageAktif, currentPageArsip);
}

async function restoreNilai(id) {
    if (!confirm('Kembalikan dari arsip?')) return;
    const mutation = `
    mutation {
        restoreNilai(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadNilaiData(currentPageAktif, currentPageArsip);
}

async function forceDeleteNilai(id) {
    if (!confirm('Hapus permanen? Data tidak bisa dikembalikan')) return;
    const mutation = `
    mutation {
        forceDeleteNilai(id: ${id}) { id }
    }`;
    await fetch(API_URL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ query: mutation }) 
    });
    loadNilaiData(currentPageAktif, currentPageArsip);
}

// --- Search ---
async function searchNilai() {
    loadNilaiData(1, 1);
}

// --- Pagination untuk Data Aktif ---
function prevPageAktif() {
    if (currentPageAktif > 1) loadNilaiData(currentPageAktif - 1, currentPageArsip);
}

function nextPageAktif() {
    loadNilaiData(currentPageAktif + 1, currentPageArsip);
}

// --- Pagination untuk Data Arsip ---
function prevPageArsip() {
    if (currentPageArsip > 1) loadNilaiData(currentPageAktif, currentPageArsip - 1);
}

function nextPageArsip() {
    loadNilaiData(currentPageAktif, currentPageArsip + 1);
}

document.addEventListener("DOMContentLoaded", () => loadNilaiData());