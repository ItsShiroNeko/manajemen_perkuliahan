function openEditModal(id, kode, ruangan, gedung, lantai, kapasitas, jenis_ruangan, fasilitas){
    document.getElementById('editId').value = id;
    document.getElementById('editKode').value = kode;
    document.getElementById('editRuangan').value = ruangan;
    document.getElementById('editGedung').value = gedung;
    document.getElementById('editLantai').value = lantai;
    document.getElementById('editKapasitas').value = kapasitas;
    document.getElementById('editJenis').value = jenis_ruangan;
    document.getElementById('editFasilitas').value = fasilitas;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateRuangan(){
    const id = document.getElementById('editId').value;
    const NewKode = document.getElementById('editKode').value;
    const NewRuangan = document.getElementById('editRuangan').value;
    const NewGedung = document.getElementById('editGedung').value;
    const NewLantai = document.getElementById('editLantai').value;
    const NewKapasitas = document.getElementById('editKapasitas').value;
    const NewJenis = document.getElementById('editJenis').value;
    const NewFasilitas = document.getElementById('editFasilitas').value;
    if(!NewRuangan){return alert("Nama Ruangan Tidak Boleh Kosong")};
    if(!NewGedung){return alert("Gedung Tidak Boleh Kosong")};
    if(!NewLantai){return alert("Lantai Tidak Boleh Kosong")};
    if(!NewKapasitas){return alert("Kapasitas Ruangan Tidak Boleh Kosong")};
    if(!NewFasilitas){return alert("Fasilitas Ruangan Tidak Boleh Kosong")};
    if(!NewJenis){return alert("Jenis Ruangan Tidak Boleh Kosong")};
    if(!NewKode) return alert("Kode Ruangan Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateRuangan(id: ${id}, input:{kode_ruangan: "${NewKode}", nama_ruangan: "${NewRuangan}", gedung: "${NewGedung}", lantai: ${NewLantai}, kapasitas: ${NewKapasitas}, jenis_ruangan: "${NewJenis}", fasilitas: "${NewFasilitas}"}){
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
        closeEditModal();
        loadRuanganData();

    }
}