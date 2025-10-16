function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addKode').value = '';
    document.getElementById('addSemester').value = '';
    document.getElementById('addTahun').value = '';
    document.getElementById('addPeriode').value = '';
    document.getElementById('addMulai').value = '';
    document.getElementById('addSelesai').value = '';
}

async function createSemester(){
    const kode = document.getElementById('addKode').value;
    const nama = document.getElementById('addSemester').value;
    const tahun = document.getElementById('addTahun').value;
    const periode = document.getElementById('addPeriode').value;
    const mulai = document.getElementById('addMulai').value;
    const selesai = document.getElementById('addSelesai').value;
    if (!kode) return alert("Kode Semester Harus Diisi!");
    if (!nama) return alert("Nama Semester Harus Diisi!");
    if (!tahun) return alert("Tahun Ajaran Semester Harus Diisi!");
    if (!periode) return alert("Periode Semester Harus Diisi!");
    if (!selesai) return alert("Tanggal Selesai Semester Harus Diisi!");
    if (!mulai) return alert("Tanggal Mulai Semester Harus Diisi!");{
        const mutation =`
        mutation {
            createSemester(input: {kode_semester: "${kode}", nama_semester: "${nama}", tahun_ajaran: "${tahun}", periode: "${periode}", tanggal_mulai: "${mulai}", tanggal_selesai: "${selesai}"}){
                id
                kode_semester
                nama_semester
                tahun_ajaran
                periode
                tanggal_mulai
                tanggal_selesai

            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        closeAddModal();
        loadSemesterData();
    }
}