async function openEditModal(id, kelas, ruangan, hari, mulai, selesai, keterangan){
    await loadKelasOptions();
    await loadRuanganOptions();
    document.getElementById('editId').value = id;
    document.getElementById('editKelasId').value = kelas;
    document.getElementById('editRuanganId').value = ruangan;
    document.getElementById('editHari').value = hari;
    document.getElementById('editMulai').value = mulai;
    document.getElementById('editSelesai').value = selesai;
    document.getElementById('editKeterangan').value = keterangan;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateJadwal(){
    const id = document.getElementById('editId').value;
    const NewKelas = document.getElementById('editKelasId').value;
    const NewRuangan = document.getElementById('editRuanganId').value;
    const NewHari = document.getElementById('editHari').value;
    const NewMulai = document.getElementById('editMulai').value;
    const NewSelesai = document.getElementById('editSelesai').value;
    const NewKeterangan = document.getElementById('editKeterangan').value;
    if(!NewKelas){return alert("Kelas Tidak Boleh Kosong")};
    if(!NewRuangan){return alert("Ruangan Tidak Boleh Kosong")};
    if(!NewHari){return alert("Hari Tidak Boleh Kosong")};
    if(!NewMulai){return alert("Jam Mulai Tidak Boleh Kosong")};
    if(!NewSelesai){return alert("Jam Selesai Tidak Boleh Kosong")};
    if(!NewKeterangan) return alert("Keterangan Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateJadwalKuliah(id: ${id}, input:{kelas_id: ${NewKelas}, ruangan_id: ${NewRuangan}, hari: "${NewHari}", jam_mulai: "${NewMulai}", jam_selesai: "${NewSelesai}", keterangan: "${NewKeterangan}"}){
                id
                kelas_id
                ruangan_id
                hari
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        alert('Data Jadwal Kuliah berhasil diupdate!');
        closeEditModal();
        loadJadwalData();

    }
}