async function openEditModal(id, kode, kelas, matakuliah, dosen, semester, kapasitas, status){
    await loadDosenOptions();
    await loadMataKuliahOptions(); 
    await loadSemesterOptions(); 
    document.getElementById('editId').value = id;
    document.getElementById('editKode').value = kode;
    document.getElementById('editKelas').value = kelas;
    document.getElementById('editMataKuliahId').value = matakuliah;
    document.getElementById('editDosenId').value = dosen;
    document.getElementById('editSemesterId').value = semester;
    document.getElementById('editKapasitas').value = kapasitas;
    document.getElementById('editStatus').value = status;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateKelas(){
    const id = document.getElementById('editId').value;
    const NewKode = document.getElementById('editKode').value;
    const NewKelas = document.getElementById('editKelas').value;
    const NewMataKuliahId = document.getElementById('editMataKuliahId').value;
    const NewDosen = document.getElementById('editDosenId').value;
    const NewSemester = document.getElementById('editSemesterId').value;
    const NewKapasitas = document.getElementById('editKapasitas').value;
    const NewStatus = document.getElementById('editStatus').value;
    if(!NewKelas){return alert("Nama Kelas Tidak Boleh Kosong")};
    if(!NewMataKuliahId){return alert("Mata Kuliah Tidak Boleh Kosong")};
    if(!NewDosen){return alert("Dosen Tidak Boleh Kosong")};
    if(!NewSemester){return alert("Semester Tidak Boleh Kosong")};
    if(!NewKapasitas){return alert("Kapasitas Tidak Boleh Kosong")};
    if(!NewStatus){return alert("Status Tidak Boleh Kosong")};
    if(!NewKode) return alert("Kode Kelas Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateKelas(id: ${id}, input:{kode_kelas: "${NewKode}", nama_kelas: "${NewKelas}", mata_kuliah_id: ${NewMataKuliahId}, dosen_id: ${NewDosen}, semester_id: ${NewSemester}, kapasitas: ${NewKapasitas}, status: "${NewStatus}"}){
                kode_kelas
                nama_kelas
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        alert('Data Kelas berhasil diupdate!');
        closeEditModal();
        loadKelasData();

    }
}