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

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editJurusanId');
        if (selectEdit) {
            selectEdit.innerHTML = '<option value="">Pilih Jurusan</option>';
            jurusanList.forEach(jurusan => {
                selectEdit.innerHTML += `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`;
            });
        }

        // Isi dropdown Add (jika ada)
        const selectAdd = document.getElementById('addJurusanId');
        if (selectAdd) {
            selectAdd.innerHTML = '<option value="">Pilih Jurusan</option>';
            jurusanList.forEach(jurusan => {
                selectAdd.innerHTML += `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`;
            });
        }

    } catch (error) {
        console.error('Error loading jurusan:', error);
    }
}

async function openEditModal(id) {
    // Load jurusan options dulu
    await loadJurusanOptions();
    
    // Query untuk mendapatkan data dosen
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
            jurusan_id
            jenis_kelamin
            tempat_lahir
            tanggal_lahir
            alamat
            no_hp
            email_pribadi
            status_kepegawaian
            jabatan
            status
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                query: query, 
                variables: { id: id.toString() } 
            })
        });

        const result = await response.json();
        
        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal memuat data dosen');
            return;
        }

        const data = result.data.Dosen;
        
        // Isi form dengan data
        document.getElementById('editId').value = data.id;
        document.getElementById('editUserId').value = data.user_id;
        document.getElementById('editNidn').value = data.nidn;
        document.getElementById('editNip').value = data.nip || '';
        document.getElementById('editNamaLengkap').value = data.nama_lengkap;
        document.getElementById('editGelarDepan').value = data.gelar_depan || '';
        document.getElementById('editGelarBelakang').value = data.gelar_belakang || '';
        document.getElementById('editJurusanId').value = data.jurusan_id;
        document.getElementById('editJenisKelamin').value = data.jenis_kelamin;
        document.getElementById('editStatusKepegawaian').value = data.status_kepegawaian;
        document.getElementById('editStatus').value = data.status;
        
        // Data optional
        document.getElementById('editTempatLahir').value = data.tempat_lahir || '';
        document.getElementById('editTanggalLahir').value = data.tanggal_lahir ? data.tanggal_lahir.split('T')[0] : '';
        document.getElementById('editAlamat').value = data.alamat || '';
        document.getElementById('editNoHp').value = data.no_hp || '';
        document.getElementById('editEmailPribadi').value = data.email_pribadi || '';
        document.getElementById('editJabatan').value = data.jabatan || '';

        // Tampilkan modal
        document.getElementById('modalEdit').classList.remove('hidden');

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data dosen');
    }
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateDosen() {
    // Ambil data dari form
    const id = parseInt(document.getElementById('editId').value);
    const nidn = document.getElementById('editNidn').value;
    const nip = document.getElementById('editNip').value || null;
    const namaLengkap = document.getElementById('editNamaLengkap').value;
    const gelarDepan = document.getElementById('editGelarDepan').value || null;
    const gelarBelakang = document.getElementById('editGelarBelakang').value || null;
    const jurusanId = parseInt(document.getElementById('editJurusanId').value);
    const jenisKelamin = document.getElementById('editJenisKelamin').value;
    const statusKepegawaian = document.getElementById('editStatusKepegawaian').value;
    const status = document.getElementById('editStatus').value;
    const userId = parseInt(document.getElementById('editUserId').value);
    
    // Data optional
    const tempatLahir = document.getElementById('editTempatLahir').value || null;
    const tanggalLahir = document.getElementById('editTanggalLahir').value || null;
    const alamat = document.getElementById('editAlamat').value || null;
    const noHp = document.getElementById('editNoHp').value || null;
    const emailPribadi = document.getElementById('editEmailPribadi').value || null;
    const jabatan = document.getElementById('editJabatan').value || null;

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
        updateDosen(
            id: ${id}
            input: {
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
            }
        ) {
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
            alert('Gagal mengupdate dosen: ' + result.errors[0].message);
            return;
        }

        alert('Dosen berhasil diupdate!');
        closeEditModal();
        
        // Reload data - cek apakah di halaman list atau detail
        if (typeof loadDosenData === 'function') {
            loadDosenData(currentPageAktif, currentPageArsip);
        } else if (typeof loadDosenDetail === 'function') {
            loadDosenDetail();
        }

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate dosen');
    }
}