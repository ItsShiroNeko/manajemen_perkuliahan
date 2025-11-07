
function openAddModal() {
    // Load jurusan options jika belum ada
    if (typeof loadJurusanOptions === 'function') {
        loadJurusanOptions();
    }
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('formAddDosen').reset();
}

async function createDosen() {
    // Ambil data dari form
    const nidn = document.getElementById('addNidn').value;
    const nip = document.getElementById('addNip').value || null;
    const namaLengkap = document.getElementById('addNamaLengkap').value;
    const gelarDepan = document.getElementById('addGelarDepan').value || null;
    const gelarBelakang = document.getElementById('addGelarBelakang').value || null;
    const jurusanId = parseInt(document.getElementById('addJurusanId').value);
    const jenisKelamin = document.getElementById('addJenisKelamin').value;
    const statusKepegawaian = document.getElementById('addStatusKepegawaian').value;
    const status = document.getElementById('addStatus').value;
    const userId = parseInt(document.getElementById('addUserId').value);
    
    // Data optional
    const tempatLahir = document.getElementById('addTempatLahir').value || null;
    const tanggalLahir = document.getElementById('addTanggalLahir').value || null;
    const alamat = document.getElementById('addAlamat').value || null;
    const noHp = document.getElementById('addNoHp').value || null;
    const emailPribadi = document.getElementById('addEmailPribadi').value || null;
    const jabatan = document.getElementById('addJabatan').value || null;

    // Validasi field required
    if (!nidn) return alert("NIDN harus diisi!");
    if (!namaLengkap) return alert("Nama Lengkap harus diisi!");
    if (!jurusanId) return alert("Jurusan harus dipilih!");
    if (!jenisKelamin) return alert("Jenis Kelamin harus dipilih!");
    if (!statusKepegawaian) return alert("Status Kepegawaian harus dipilih!");
    if (!status) return alert("Status harus dipilih!");
    if (!userId) return alert("User ID harus diisi!");

    // Build mutation dengan handling null values
    const mutation = `
    mutation {
        createDosen(input: {
            user_id: ${userId}
            nidn: "${nidn}"
            ${nip ? `nip: "${nip}"` : ''}
            nama_lengkap: "${namaLengkap}"
            ${gelarDepan ? `gelar_depan: "${gelarDepan}"` : ''}
            ${gelarBelakang ? `gelar_belakang: "${gelarBelakang}"` : ''}
            jurusan_id: ${jurusanId}
            jenis_kelamin: "${jenisKelamin}"
            status_kepegawaian: "${statusKepegawaian}"
            status: "${status}"
            ${tempatLahir ? `tempat_lahir: "${tempatLahir}"` : ''}
            ${tanggalLahir ? `tanggal_lahir: "${tanggalLahir}"` : ''}
            ${alamat ? `alamat: "${alamat}"` : ''}
            ${noHp ? `no_hp: "${noHp}"` : ''}
            ${emailPribadi ? `email_pribadi: "${emailPribadi}"` : ''}
            ${jabatan ? `jabatan: "${jabatan}"` : ''}
        }) {
            id
            nidn
            nama_lengkap
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query: mutation })
        });

        const result = await response.json();

        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal menambahkan dosen: ' + result.errors[0].message);
            return;
        }

        alert('Dosen berhasil ditambahkan!');
        closeAddModal();
        loadDosenData(currentPageAktif, currentPageArsip);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan dosen');
    }
}

// Tidak perlu load jurusan di DOMContentLoaded karena sudah di-load oleh dosen-edit.js