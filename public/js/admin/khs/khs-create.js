async function loadMahasiswaOptions() {
    const query = `
    query {
        allMahasiswa {
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
        const mahasiswaList = result.data.allMahasiswa || [];
        

        // Isi dropdown Add
        const selectAdd = document.getElementById('addMahasiswaId');
        selectAdd.innerHTML = '<option value="">Pilih Mahasiswa</option>';
        mahasiswaList.forEach(mahasiswa => {
            selectAdd.innerHTML += `<option value="${mahasiswa.id}">${mahasiswa.nama_lengkap}</option>`;
        });

        // Isi dropdown Edit
        const selectEdit = document.getElementById('editMahasiswaId');
        selectEdit.innerHTML = '<option value="">Pilih Mahasiswa</option>';
        mahasiswaList.forEach(mahasiswa => {
            selectEdit.innerHTML += `<option value="${mahasiswa.id}">${mahasiswa.nama_lengkap}</option>`;
        });

    } catch (error) {
        console.error('Error loading mahasiswa:', error);
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

function openAddModal() {
    loadSemesterOptions();
    loadMahasiswaOptions();
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addMahasiswaId').value = '';
    document.getElementById('addSemesterId').value = '';
    document.getElementById('addSksSemester').value = '';
    document.getElementById('addSksKumulatif').value = '';
    document.getElementById('addIpSemester').value = '';
    document.getElementById('addIPK').value = '';
}

async function createKhs() {
    // Ambil data dari form
    const mahasiswa = document.getElementById('addMahasiswaId').value;
    const semester = document.getElementById('addSemesterId').value;
    const sks_semester = document.getElementById('addSksSemester').value;
    const sks_kumulatif = document.getElementById('addSksKumulatif').value;
    const ip_semester = document.getElementById('addIpSemester').value;
    const ipk = document.getElementById('addIPK').value;

    // Validasi field required
    if (!mahasiswa) return alert("mahasiswa harus diisi!");
    if (!semester) return alert("semester harus diisi!");
    if (!sks_semester) return alert("sks semester harus dipilih!");
    if (!sks_kumulatif) return alert("sks kumulatif dipilih!");
    if (!ip_semester) return alert("ip semester dipilih!");
    if (!ipk) return alert("ipk harus dipilih!");
    const mutation = `
    mutation {
        createKhs(input: {
            mahasiswa_id: ${mahasiswa}
            semester_id: ${semester}
            sks_semester: ${sks_semester}
            sks_kumulatif: ${sks_kumulatif}
            ip_semester: ${ip_semester}
            ipk: ${ipk}
        }) {
            id
            mahasiswa_id
            semester_id
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
            alert('Gagal menambahkan KHS: ' + result.errors[0].message);
            return;
        }

        alert('Kelas berhasil ditambahkan!');
        closeAddModal();
        loadKhsData(currentPageAktif, currentPageArsip);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan KHS');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    loadMahasiswaOptions();
    loadSemesterOptions();
});