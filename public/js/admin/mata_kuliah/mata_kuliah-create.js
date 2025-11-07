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
    loadJurusanOptions();
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addKode').value = '';
    document.getElementById('addMataKuliah').value = '';
    document.getElementById('addJurusanId').value = '';
    document.getElementById('addSks').value = '';
    document.getElementById('addRekomendasi').value = '';
    document.getElementById('addJenis').value = '';
    document.getElementById('addDeskripsi').value = '';
}

async function createMataKuliah() {
    // Ambil data dari form
    const kode_mk = document.getElementById('addKode').value;
    const matakuliah = document.getElementById('addMataKuliah').value;
    const jurusan = document.getElementById('addJurusanId').value;
    const sks = document.getElementById('addSks').value;
    const rekomendasi = document.getElementById('addRekomendasi').value;
    const jenis = document.getElementById('addJenis').value;
    const deskripsi = document.getElementById('addDeskripsi').value;

    // Validasi field required
    if (!kode_mk) return alert("Kode Mata Kuliah harus diisi!");
    if (!matakuliah) return alert("Mata Kuliah harus diisi!");
    if (!jurusan) return alert("Jurusan harus dipilih!");
    if (!sks) return alert("SKS harus diisi!");
    if (!rekomendasi) return alert("Semester Rekomendasi Harus diisi!");
    if (!jenis) return alert("Jenis harus dipilih!");
    if (!deskripsi) return alert("Deskripsi harus diisi!");
    const mutation = `
    mutation {
        createMataKuliah(input: {
            kode_mk: "${kode_mk}"
            nama_mk: "${matakuliah}"
            jurusan_id: ${jurusan}
            sks: ${sks}
            semester_rekomendasi: ${rekomendasi}
            jenis: "${jenis}"
            deskripsi: "${deskripsi}"
        }) {
            id
            kode_mk
            nama_mk
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
            alert('Gagal menambahkan Mata Kuliah: ' + result.errors[0].message);
            return;
        }

        alert('Mata Kuliah berhasil ditambahkan!');
        closeAddModal();
        loadMataKuliahData(currentPageAktif, currentPageArsip);

    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambahkan mata kuliah');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    loadJurusanOptions();
});