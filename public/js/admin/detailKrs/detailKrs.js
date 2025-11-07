const API_URL = "/graphql";
let currentKrsId = null;
let currentKrsData = null;
let krsDetailList = [];

function getKrsIdFromUrl() {
    const path = window.location.pathname;
    const segments = path.split('/');
    return segments[segments.length - 1];
}

async function loadKrsDetail() {
    currentKrsId = getKrsIdFromUrl();
    
    const query = `
    query($krs_id: ID!) {
        krsdetail(krs_id: $krs_id) {
            id
            krs_id
            kelas_id
            mata_kuliah_id
            sks
            status_ambil
            created_at
            updated_at
            krs {
                id
                semester {
                    id
                    nama_semester
                    tahun_ajaran
                  }
                tanggal_pengisian
                status
                total_sks
                mahasiswa {
                    id
                    nim
                    nama_lengkap
                    jurusan {
                        id
                        nama_jurusan
                    }
                    semester_saat_ini
                }
            }
            kelas {
                id
                nama_kelas
                dosen {
                    id
                    nama_lengkap
                }
            }
            mataKuliah {
                id
                kode_mk
                nama_mk
                sks
            }
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: query, 
                variables: { krs_id: currentKrsId } 
            })
        });

        const result = await response.json();
        
        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal memuat data KRS');
            return;
        }

        krsDetailList = result.data.krsdetail || [];
        
        if (krsDetailList.length === 0) {
            alert('Data KRS tidak ditemukan');
            window.location.href = '/krs';
            return;
        }

        currentKrsData = krsDetailList[0].krs;
        
        renderKrsDetail(currentKrsData, krsDetailList);
        
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('content').classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data');
    }
}

function renderKrsDetail(krsData, detailList) {
    if (!krsData || !krsData.mahasiswa) return;
    console.log(krsData)
    
    // Header Section
    const initial = krsData.mahasiswa.nama_lengkap.charAt(0).toUpperCase();
    document.getElementById('initial').textContent = initial;
    document.getElementById('nama').textContent = krsData.mahasiswa.nama_lengkap;
    document.getElementById('nim').textContent = krsData.mahasiswa.nim;
    document.getElementById('statusHeader').textContent = krsData.status     || '-';

    // Tab Info KRS - Mahasiswa Section
    document.getElementById('krsId').textContent = krsData.id;
    document.getElementById('mahasiswaNama').textContent = krsData.mahasiswa.nama_lengkap;
    document.getElementById('mahasiswaNim').textContent = krsData.mahasiswa.nim;
    document.getElementById('jurusan').textContent = krsData.mahasiswa.jurusan?.nama_jurusan || '-';
    
    // Tab Info KRS - Detail KRS Section
    document.getElementById('semester').textContent = krsData.semester.nama_semester || '-';
    document.getElementById('tahunAjaran').textContent = krsData.semester.tahun_ajaran || '-';
    document.getElementById('tanggalPengisian').textContent = formatDate(krsData.tanggal_pengisian);
    
    // Status dengan badge
    const statusElement = document.getElementById('statusKrs');
    statusElement.innerHTML = getStatusKrsBadge(krsData.status  );
    
    // Calculate total SKS from detail list
    const totalSks = detailList.reduce((sum, detail) => sum + (detail.sks || 0), 0);
    
    document.getElementById('totalSks').textContent = totalSks;
    document.getElementById('ipSemester').textContent = krsData.ip_semester ? krsData.ip_semester.toFixed(2) : '-';

    // Summary Cards
    document.getElementById('totalSksBesar').textContent = totalSks;
    document.getElementById('totalMatakuliah').textContent = detailList.length;
    document.getElementById('ipSemesterBesar').textContent = krsData.ip_semester ? krsData.ip_semester.toFixed(2) : '-';

    renderMataKuliahTable(detailList);
    if (detailList.length > 0) {
        const firstDetail = detailList[0];
        document.getElementById('createdAt').textContent = formatDateTime(firstDetail.created_at);
        document.getElementById('updatedAt').textContent = formatDateTime(firstDetail.updated_at);
    }
}

function renderMataKuliahTable(detailList) {
    const tbody = document.getElementById('mataKuliahTableBody');
    tbody.innerHTML = '';

    if (detailList.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada mata kuliah yang diambil
                </td>
            </tr>
        `;
        return;
    }

    detailList.forEach((detail, index) => {
        const row = document.createElement('tr');
        row.className = 'border-b hover:bg-gray-50';
    
        const jadwal = detail.kelas?.hari && detail.kelas?.jam_mulai 
            ? `${detail.kelas.hari}, ${detail.kelas.jam_mulai}-${detail.kelas.jam_selesai}` 
            : '-';
        
        // Format dosen
        const dosen = detail.kelas?.dosen?.nama_lengkap || '-';
        
        // Nilai
        const nilai = detail.nilai?.nilai_huruf || '-';
        
        row.innerHTML = `
            <td class="px-6 py-4 text-sm text-gray-900">${index + 1}</td>
            <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">${detail.mataKuliah?.nama_mk || '-'}</div>
                <div class="text-sm text-gray-500">${detail.mataKuliah?.kode_mk || '-'}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">${detail.kelas?.nama_kelas || '-'}</div>
                <div class="text-xs text-gray-500">${jadwal}</div>
            </td>
            <td class="px-6 py-4">
                <div class="text-sm text-gray-900">${dosen}</div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-900 text-center">${detail.sks || '0'}</td>
            <td class="px-6 py-4">${getStatusAmbilBadge(detail.status_ambil)}</td>
            <td class="px-6 py-4 text-center">
                <span class="font-semibold ${getNilaiColor("nilai")}">${nilai}</span>
            </td>
        `;
        tbody.appendChild(row);
    });
}

function getNilaiColor(nilai) {
    if (nilai === 'A' || nilai === 'A-') return 'text-green-600';
    if (nilai === 'B+' || nilai === 'B' || nilai === 'B-') return 'text-blue-600';
    if (nilai === 'C+' || nilai === 'C') return 'text-yellow-600';
    if (nilai === 'D' || nilai === 'E') return 'text-red-600';
    return 'text-gray-600';
}

function getStatusKrsBadge(status) {
    const badges = {
        'DRAFT': '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">Draft</span>',
        'DIAJUKAN': '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Diajukan</span>',
        'DISETUJUI': '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Disetujui</span>',
        'DITOLAK': '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Ditolak</span>',
        'AKTIF': '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Aktif</span>'
    };
    return badges[status?.toUpperCase()] || `<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">${status || '-'}</span>`;
}

function getStatusAmbilBadge(status) {
    const badges = {
        'BARU': '<span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">Baru</span>',
        'MENGULANG': '<span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-semibold">Mengulang</span>',
        'PERBAIKAN': '<span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-semibold">Perbaikan</span>'
    };
    return badges[status?.toUpperCase()] || `<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs font-semibold">${status || '-'}</span>`;
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

function formatDateTime(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return date.toLocaleDateString('id-ID', options);
}

// Tab Navigation
function showTab(tabName) {
    const tabs = ['info', 'matakuliah'];
    tabs.forEach(tab => {
        const tabBtn = document.getElementById(`tab${tab.charAt(0).toUpperCase() + tab.slice(1)}`);
        const content = document.getElementById(`content${tab.charAt(0).toUpperCase() + tab.slice(1)}`);
        
        if (tab === tabName) {
            tabBtn.classList.add('border-b-2', 'border-blue-500', 'text-blue-600', 'font-semibold');
            tabBtn.classList.remove('text-gray-600');
            content.classList.remove('hidden');
        } else {
            tabBtn.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600', 'font-semibold');
            tabBtn.classList.add('text-gray-600');
            content.classList.add('hidden');
        }
    });
}

// Delete KRS
async function confirmDelete() {
    if (!currentKrsData) return;
    
    if (!confirm(`Hapus KRS semester ${currentKrsData.semester} mahasiswa ${currentKrsData.mahasiswa.nama_lengkap}?\n\nSemua detail mata kuliah akan ikut terhapus.`)) return;
    
    const mutation = `
    mutation($id: ID!) {
        deleteKrs(id: $id) { 
            id 
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: mutation,
                variables: { id: currentKrsId }
            })
        });
        
        const result = await response.json();
        
        if (result.errors) {
            throw new Error(result.errors[0].message);
        }
        
        alert('KRS berhasil dihapus');
        window.location.href = '/krs';
        
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal menghapus KRS: ' + error.message);
    }
}

// Approve KRS
async function approveKrs() {
    if (!currentKrsData) return;
    
    if (!confirm(`Setujui KRS semester ${currentKrsData.semester} mahasiswa ${currentKrsData.mahasiswa.nama_lengkap}?`)) return;
    
    const mutation = `
    mutation($id: ID!) {
        updateKrs(id: $id, input: { status_krs: "DISETUJUI" }) {
            id
            status_krs
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: mutation,
                variables: { id: currentKrsId }
            })
        });
        
        const result = await response.json();
        
        if (result.errors) {
            throw new Error(result.errors[0].message);
        }
        
        alert('KRS berhasil disetujui');
        loadKrsDetail(); // Reload data
        
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal menyetujui KRS: ' + error.message);
    }
}

// Reject KRS
async function rejectKrs() {
    if (!currentKrsData) return;
    
    const alasan = prompt(`Tolak KRS semester ${currentKrsData.semester} mahasiswa ${currentKrsData.mahasiswa.nama_lengkap}?\n\nBerikan alasan penolakan (opsional):`);
    
    if (alasan === null) return; // User cancelled
    
    const mutation = `
    mutation($id: ID!) {
        updateKrs(id: $id, input: { status_krs: "DITOLAK" }) {
            id
            status_krs
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: mutation,
                variables: { id: currentKrsId }
            })
        });
        
        const result = await response.json();
        
        if (result.errors) {
            throw new Error(result.errors[0].message);
        }
        
        alert('KRS berhasil ditolak' + (alasan ? `\nAlasan: ${alasan}` : ''));
        loadKrsDetail(); // Reload data
        
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal menolak KRS: ' + error.message);
    }
}

// Load data on page load
document.addEventListener('DOMContentLoaded', () => {
    loadKrsDetail();
});