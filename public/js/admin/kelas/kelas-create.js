async function loadDosenOptions() {
    const query = `
    query {
        allDosen {
            id
            nama_lengkap
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        });

        const result = await response.json();
        const dosenList = result.data.allDosen || [];
        

        // Isi dropdown Add
        const selectAdd = document.getElementById('addDosenId');
        selectAdd.innerHTML = '<option value="">Pilih Dosen</option>';
        dosenList.forEach(dosen => {
            selectAdd.innerHTML += `<option value="${dosen.id}">${dosen.nama_lengkap}</option>`;
        });

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editDosenId');
        selectEdit.innerHTML = '<option value="">Pilih Dosen</option>';
        dosenList.forEach(dosen => {
            selectEdit.innerHTML += `<option value="${dosen.id}">${dosen.nama_lengkap}</option>`;
        });

    } catch (error) {
        console.error('Error loading dosen:', error);
    }
}
async function loadSemesterOptions() {
    const query = `
    query {
        allSemester {
            id
            nama_semester
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        });

        const result = await response.json();
        
        const semesterList = result.data.allSemester || [];

        // Isi dropdown Add
        const selectAdd = document.getElementById('addSemesterId');
        selectAdd.innerHTML = '<option value="">Pilih Semester</option>';
        semesterList.forEach(Semester => {
            selectAdd.innerHTML += `<option value="${Semester.id}">${Semester.nama_semester}</option>`;
        });

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editSemesterId');
        selectEdit.innerHTML = '<option value="">Pilih Semester</option>';
        semesterList.forEach(Semester => {
            selectEdit.innerHTML += `<option value="${Semester.id}">${Semester.nama_semester}</option>`;
        });

    } catch (error) {
        console.error('Error loading Semester:', error);
    }
}
async function loadMataKuliahOptions() {
    const query = `
    query {
        allMataKuliah {
            id
            nama_mk
        }
    }`;

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ query })
        });

        const result = await response.json();
        
        const matakuliahList = result.data.allMataKuliah || [];

        // Isi dropdown Add
        const selectAdd = document.getElementById('addMataKuliahId');
        selectAdd.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
        matakuliahList.forEach(MataKuliah => {
            selectAdd.innerHTML += `<option value="${MataKuliah.id}">${MataKuliah.nama_mk}</option>`;
        });

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editMataKuliahId');
        selectEdit.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
        matakuliahList.forEach(MataKuliah => {
            selectEdit.innerHTML += `<option value="${MataKuliah.id}">${MataKuliah.nama_mk}</option>`;
        });

    } catch (error) {
        console.error('Error loading Mata Kuliah:', error);
    }
}

function openAddModal() {
    loadDosenOptions();
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addKode').value = '';
    document.getElementById('addKelas').value = '';
    document.getElementById('addMataKuliahId').value = '';
    document.getElementById('addDosenId').value = '';
    document.getElementById('addSemesterId').value = '';
    document.getElementById('addKapasitas').value = '';
    document.getElementById('addStatus').value = '';
}

async function createKelas() {
    // Ambil data dari form
    const kode_kelas = document.getElementById('addKode').value;
    const kelas = document.getElementById('addKelas').value;
    const matakuliahid = document.getElementById('addMataKuliahId').value;
    const dosenid = document.getElementById('addDosenId').value;
    const semesterid = document.getElementById('addSemesterId').value;
    const kapasitas = document.getElementById('addKapasitas').value;
    const status = document.getElementById('addStatus').value;

    // Validasi field required
    if (!kode_kelas) return alert("kode kelas harus diisi!");
    if (!kelas) return alert("Nama Kelas harus diisi!");
    if (!matakuliahid) return alert("Mata Kuliah harus dipilih!");
    if (!dosenid) return alert("Dosen harus dipilih!");
    if (!semesterid) return alert("Semester harus dipilih!");
    if (!kapasitas) return alert("Kapasitas harus dipilih!");
    if (!status) return alert("Status harus diisi!");
    const mutation = `
    mutation {
        createKelas(input: {
            kode_kelas: "${kode_kelas}"
            nama_kelas: "${kelas}"
            mata_kuliah_id: ${matakuliahid}
            dosen_id: ${dosenid}
            semester_id: ${semesterid}
            kapasitas: ${kapasitas}
            status: "${status}"
        }) {
            id
            kode_kelas
            nama_kelas
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
            alert('Gagal menambahkan Kelas: ' + result.errors[0].message);
            return;
        }

        alert('Kelas berhasil ditambahkan!');
        closeAddModal();
        loadKelasData(currentPageAktif, currentPageArsip);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan mata kuliah');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    loadDosenOptions();
    loadMataKuliahOptions();
    loadSemesterOptions();
});