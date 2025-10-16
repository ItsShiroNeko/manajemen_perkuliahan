function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addKode').value = '';
    document.getElementById('addRuangan').value = '';
    document.getElementById('addGedung').value = '';
    document.getElementById('addLantai').value = '';
    document.getElementById('addKapasitas').value = '';
    document.getElementById('addJenis').value = '';
    document.getElementById('addFasilitas').value = '';
}

async function createRuangan(){
    const kode = document.getElementById('addKode').value;
    const ruangan = document.getElementById('addRuangan').value;
    const gedung = document.getElementById('addGedung').value;
    const lantai = document.getElementById('addLantai').value;
    const kapasitas = document.getElementById('addKapasitas').value;
    const jenis = document.getElementById('addJenis').value;
    const fasilitas = document.getElementById('addFasilitas').value;
    if (!kode) return alert("Kode Ruangan Harus Diisi!");
    if (!ruangan) return alert("Nama Ruangan Harus Diisi!");
    if (!gedung) return alert("Gedung Harus Diisi!");
    if (!lantai) return alert("Lantai Harus Diisi!");
    if (!kapasitas) return alert("Kapasitas Harus Diisi!");
    if (!jenis) return alert("Jenis Ruangan Harus Diisi!");
    if (!fasilitas) return alert("Fasilitas Gedung Harus Diisi!");{
        const mutation =`
        mutation {
            createRuangan(input: {kode_ruangan: "${kode}", nama_ruangan: "${ruangan}", gedung: "${gedung}", lantai: ${lantai}, kapasitas: ${kapasitas}, jenis_ruangan: "${jenis}",fasilitas: "${fasilitas}"}){
                id
                kode_ruangan
                nama_ruangan
                gedung
                lantai
                kapasitas
                jenis_ruangan
                fasilitas

            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        closeAddModal();
        loadRuanganData();
    }
}