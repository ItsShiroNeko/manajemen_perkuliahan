const API_URL = "/graphql";
let currentDosenId = null;
let currentDosenData = null;

// Ambil ID dari URL
function getDosenIdFromUrl() {
    const path = window.location.pathname;
    const segments = path.split('/');
    return segments[segments.length - 1]; // Ambil segment terakhir (id)
}

async function loadDosenDetail() {
    currentDosenId = getDosenIdFromUrl();
    
    const query = `
    query($id: ID!) {
        Dosen(id: $id) {
            id
            user_id
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
            tempat_lahir
            tanggal_lahir
            alamat
            no_hp
            email_pribadi
            status_kepegawaian
            jabatan
            status
            created_at
            updated_at
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: query, 
                variables: { id: currentDosenId } 
            })
        });

        const result = await response.json();
        
        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal memuat data dosen');
            return;
        }

        currentDosenData = result.data.Dosen;
        renderDosenDetail(currentDosenData);
        
        // Hide loading, show content
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('content').classList.remove('hidden');
        
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data');
    }
}

function renderDosenDetail(data) {
    // Format nama dengan gelar
    let namaLengkap = data.nama_lengkap;
    let namaWithGelar = namaLengkap;
    if (data.gelar_depan || data.gelar_belakang) {
        namaWithGelar = `${data.gelar_depan || ''} ${data.nama_lengkap} ${data.gelar_belakang || ''}`.trim();
    }

    // Header Section
    const initial = data.nama_lengkap.charAt(0).toUpperCase();
    document.getElementById('initial').textContent = initial;
    document.getElementById('nama').textContent = namaWithGelar;
    document.getElementById('nidn').textContent = data.nidn;
    document.getElementById('statusHeader').textContent = data.status || '-';

    // Tab Biodata
    document.getElementById('namaLengkap').textContent = namaLengkap;
    document.getElementById('gelar').textContent = `${data.gelar_depan || '-'} / ${data.gelar_belakang || '-'}`;
    document.getElementById('jenisKelamin').textContent = data.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    document.getElementById('tanggalLahir').textContent = formatDate(data.tanggal_lahir);
    document.getElementById('tempatLahir').textContent = data.tempat_lahir || '-';
    document.getElementById('alamat').textContent = data.alamat || '-';

    // Tab Kepegawaian
    document.getElementById('nidnKepegawaian').textContent = data.nidn;
    document.getElementById('nip').textContent = data.nip || '-';
    document.getElementById('jurusan').textContent = data.jurusan?.nama_jurusan || '-';
    document.getElementById('statusKepegawaian').textContent = data.status_kepegawaian || '-';
    document.getElementById('jabatan').textContent = data.jabatan || '-';
    
    // Status dengan innerHTML untuk badge
    const statusElement = document.getElementById('status');
    statusElement.innerHTML = getStatusBadge(data.status);

    // Tab Kontak
    document.getElementById('noHp').textContent = data.no_hp || '-';
    document.getElementById('emailPribadi').textContent = data.email_pribadi || '-';

    // Metadata
    document.getElementById('userId').textContent = data.user_id;
    document.getElementById('createdAt').textContent = formatDateTime(data.created_at);
    document.getElementById('updatedAt').textContent = formatDateTime(data.updated_at);
}

function getStatusBadge(status) {
    const badges = {
        'AKTIF': '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Aktif</span>',
        'CUTI': '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Cuti</span>',
        'PENSIUN': '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Pensiun</span>',
        'NONAKTIF': '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Nonaktif</span>'
    };
    return badges[status?.toUpperCase()] || `<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">${status || '-'}</span>`;
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
    // Update tab buttons
    const tabs = ['biodata', 'kepegawaian', 'kontak'];
    tabs.forEach(tab => {
        const tabBtn = document.getElementById(`tab${tab.charAt(0).toUpperCase() + tab.slice(1)}`);
        const content = document.getElementById(`content${tab.charAt(0).toUpperCase() + tab.slice(1)}`);
        
        if (tab === tabName) {
            tabBtn.classList.add('border-b-2', 'border-green-500', 'text-green-600', 'font-semibold');
            tabBtn.classList.remove('text-gray-600');
            content.classList.remove('hidden');
        } else {
            tabBtn.classList.remove('border-b-2', 'border-green-500', 'text-green-600', 'font-semibold');
            tabBtn.classList.add('text-gray-600');
            content.classList.add('hidden');
        }
    });
}

// Edit Modal
function openEditModal() {
    // Fungsi ini akan dipanggil dari dosen-edit.js
    // Passing data ke modal edit dengan ID
    if (typeof window.openEditModal === 'function') {
        // Panggil fungsi openEditModal dari dosen-edit.js dengan parameter ID
        openEditModal(currentDosenId);
    } else {
        alert('Fungsi edit belum tersedia. Silakan edit dari halaman utama.');
    }
}

// Delete/Archive
async function confirmDelete() {
    if (!confirm(`Arsipkan dosen ${currentDosenData.nama_lengkap}?`)) return;
    
    const mutation = `
    mutation {
        deleteDosen(id: ${currentDosenId}) { id }
    }`;

    try {
        await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query: mutation })
        });
        
        alert('Dosen berhasil diarsipkan');
        window.location.href = '/dosen'; // Redirect ke list
        
    } catch (error) {
        console.error('Error:', error);
        alert('Gagal mengarsipkan dosen');
    }
}

// Load data on page load
document.addEventListener('DOMContentLoaded', () => {
    loadDosenDetail();
});