
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
        const selectEdit = document.getElementById('editJurusanId');
        if (selectEdit) {
            selectEdit.innerHTML = '<option value="">Pilih Jurusan</option>';
            jurusanList.forEach(jurusan => {
                selectEdit.innerHTML += `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`;
            });
        }

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
    await loadJurusanOptions();
    
    const query = `
    query {
        mahasiswa(id: ${id}) {
            id
            user_id
            nim
            nama_lengkap
            jurusan_id
            angkatan
            jenis_kelamin
            tempat_lahir
            tanggal_lahir
            alamat
            no_hp
            email_pribadi
            nama_ayah
            nama_ibu
            no_hp_ortu
            status
            semester_saat_ini
            ipk
            total_sks
        }
    }`;


    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        });
        

        const result = await response.json();
        
        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal memuat data mahasiswa');
            return;
        }

        const data = result.data.mahasiswa;
        
        document.getElementById('editId').value = data.id;
        document.getElementById('editUserId').value = data.user_id;
        document.getElementById('editNim').value = data.nim;
        document.getElementById('editNamaLengkap').value = data.nama_lengkap;
        document.getElementById('editJurusanId').value = data.jurusan_id;
        document.getElementById('editAngkatan').value = data.angkatan;
        document.getElementById('editJenisKelamin').value = data.jenis_kelamin;
        document.getElementById('editStatus').value = data.status;
        document.getElementById('editSemester').value = data.semester_saat_ini;
        
        document.getElementById('editTempatLahir').value = data.tempat_lahir || '';
        document.getElementById('editTanggalLahir').value = data.tanggal_lahir ? data.tanggal_lahir.split('T')[0] : '';
        document.getElementById('editAlamat').value = data.alamat || '';
        document.getElementById('editNoHp').value = data.no_hp || '';
        document.getElementById('editEmailPribadi').value = data.email_pribadi || '';
        document.getElementById('editNamaAyah').value = data.nama_ayah || '';
        document.getElementById('editNamaIbu').value = data.nama_ibu || '';
        document.getElementById('editNoHpOrtu').value = data.no_hp_ortu || '';
        document.getElementById('editIpk').value = data.ipk || '';
        document.getElementById('editTotalSks').value = data.total_sks || '';

        document.getElementById('modalEdit').classList.remove('hidden');

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data mahasiswa');
    }
}

function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateMahasiswa() {
    const id = parseInt(document.getElementById('editId').value);
    const nim = document.getElementById('editNim').value;
    const namaLengkap = document.getElementById('editNamaLengkap').value;
    const jurusanId = parseInt(document.getElementById('editJurusanId').value);
    const angkatan = parseInt(document.getElementById('editAngkatan').value);
    const jenisKelamin = document.getElementById('editJenisKelamin').value;
    const status = document.getElementById('editStatus').value;
    const semesterSaatIni = parseInt(document.getElementById('editSemester').value);
    const userId = parseInt(document.getElementById('editUserId').value);
    
    const tempatLahir = document.getElementById('editTempatLahir').value || null;
    const tanggalLahir = document.getElementById('editTanggalLahir').value || null;
    const alamat = document.getElementById('editAlamat').value || null;
    const noHp = document.getElementById('editNoHp').value || null;
    const emailPribadi = document.getElementById('editEmailPribadi').value || null;
    const namaAyah = document.getElementById('editNamaAyah').value || null;
    const namaIbu = document.getElementById('editNamaIbu').value || null;
    const noHpOrtu = document.getElementById('editNoHpOrtu').value || null;
    const ipk = document.getElementById('editIpk').value ? parseFloat(document.getElementById('editIpk').value) : null;
    const totalSks = document.getElementById('editTotalSks').value ? parseInt(document.getElementById('editTotalSks').value) : null;

    if (!nim) return alert("NIM harus diisi!");
    if (!namaLengkap) return alert("Nama Lengkap harus diisi!");
    if (!jurusanId) return alert("Jurusan harus dipilih!");
    if (!angkatan) return alert("Angkatan harus diisi!");
    if (!jenisKelamin) return alert("Jenis Kelamin harus dipilih!");
    if (!status) return alert("Status harus dipilih!");
    if (!semesterSaatIni) return alert("Semester Saat Ini harus diisi!");
    if (!userId) return alert("User ID harus diisi!");

    const mutation = `
    mutation {
        updateMahasiswa(
            id: ${id}
            input: {
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
            }
        ) {
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
            alert('Gagal mengupdate mahasiswa: ' + result.errors[0].message);
            return;
        }

        alert('Mahasiswa berhasil diupdate!');
        closeEditModal();
        
        if (typeof loadMahasiswaData === 'function') {
            loadMahasiswaData(currentPageAktif, currentPageArsip);
        } else if (typeof loadMahasiswaDetail === 'function') {
            loadMahasiswaDetail();
        }

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate mahasiswa');
    }
}