// Load data jurusan untuk dropdown
async function loadJurusanOptions() {
    const query = `
    query {
        allJurusan {
            id
            nama_jurusan
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        });

        const result = await response.json();
        const jurusanList = result.data.allJurusan || [];

        // Isi dropdown Add
        const selectAdd = document.getElementById('addJurusanId');
        selectAdd.innerHTML = '<option value="">Pilih Jurusan</option>';
        jurusanList.forEach(jurusan => {
            selectAdd.innerHTML += `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`;
        });

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editJurusanId');
        selectEdit.innerHTML = '<option value="">Pilih Jurusan</option>';
        jurusanList.forEach(jurusan => {
            selectEdit.innerHTML += `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`;
        });

    } catch (error) {
        console.error('Error loading jurusan:', error);
    }
}

function openAddModal() {
    loadJurusanOptions(); // Load jurusan setiap kali modal dibuka
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('formAddMahasiswa').reset();
}

async function createMahasiswa() {
    // Ambil data dari form
    const nim = document.getElementById('addNim').value;
    const namaLengkap = document.getElementById('addNamaLengkap').value;
    const jurusanId = parseInt(document.getElementById('addJurusanId').value);
    const angkatan = parseInt(document.getElementById('addAngkatan').value);
    const jenisKelamin = document.getElementById('addJenisKelamin').value;
    const status = document.getElementById('addStatus').value;
    const semesterSaatIni = parseInt(document.getElementById('addSemester').value);
    const userId = parseInt(document.getElementById('addUserId').value);
    
    // Data optional
    const tempatLahir = document.getElementById('addTempatLahir').value || null;
    const tanggalLahir = document.getElementById('addTanggalLahir').value || null;
    const alamat = document.getElementById('addAlamat').value || null;
    const noHp = document.getElementById('addNoHp').value || null;
    const emailPribadi = document.getElementById('addEmailPribadi').value || null;
    const namaAyah = document.getElementById('addNamaAyah').value || null;
    const namaIbu = document.getElementById('addNamaIbu').value || null;
    const noHpOrtu = document.getElementById('addNoHpOrtu').value || null;
    const ipk = document.getElementById('addIpk').value ? parseFloat(document.getElementById('addIpk').value) : null;
    const totalSks = document.getElementById('addTotalSks').value ? parseInt(document.getElementById('addTotalSks').value) : null;

    // Validasi field required
    if (!nim) return alert("NIM harus diisi!");
    if (!namaLengkap) return alert("Nama Lengkap harus diisi!");
    if (!jurusanId) return alert("Jurusan harus dipilih!");
    if (!angkatan) return alert("Angkatan harus diisi!");
    if (!jenisKelamin) return alert("Jenis Kelamin harus dipilih!");
    if (!status) return alert("Status harus dipilih!");
    if (!semesterSaatIni) return alert("Semester Saat Ini harus diisi!");
    if (!userId) return alert("User ID harus diisi!");

    // Build mutation dengan handling null values
    const mutation = `
    mutation {
        createMahasiswa(input: {
            user_id: ${userId}
            nim: "${nim}"
            nama_lengkap: "${namaLengkap}"
            jurusan_id: ${jurusanId}
            angkatan: ${angkatan}
            jenis_kelamin: "${jenisKelamin}"
            status: "${status}"
            semester_saat_ini: ${semesterSaatIni}
            ${tempatLahir ? `tempat_lahir: "${tempatLahir}"` : ''}
            ${tanggalLahir ? `tanggal_lahir: "${tanggalLahir}"` : ''}
            ${alamat ? `alamat: "${alamat}"` : ''}
            ${noHp ? `no_hp: "${noHp}"` : ''}
            ${emailPribadi ? `email_pribadi: "${emailPribadi}"` : ''}
            ${namaAyah ? `nama_ayah: "${namaAyah}"` : ''}
            ${namaIbu ? `nama_ibu: "${namaIbu}"` : ''}
            ${noHpOrtu ? `no_hp_ortu: "${noHpOrtu}"` : ''}
            ${ipk !== null ? `ipk: ${ipk}` : ''}
            ${totalSks !== null ? `total_sks: ${totalSks}` : ''}
        }) {
            id
            nim
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
            alert('Gagal menambahkan mahasiswa: ' + result.errors[0].message);
            return;
        }

        alert('Mahasiswa berhasil ditambahkan!');
        closeAddModal();
        loadMahasiswaData(currentPageAktif, currentPageArsip);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan mahasiswa');
    }
}

// Load jurusan saat halaman pertama kali dimuat
document.addEventListener('DOMContentLoaded', () => {
    loadJurusanOptions();
});