async function openEditModal(id, mahasiswa, semester, tanggal_pengisian, tanggal_persetujuan, status, total_sks, catatan, dosenPa){
    await loadMahasiswaOptions();
    await loadSemesterOptions(); 
    await loadDosenOptions();
    document.getElementById('editId').value = id;
    document.getElementById('editMahasiswaId').value = mahasiswa;
    document.getElementById('editSemesterId').value = semester;
    document.getElementById('editPengisian').value = tanggal_pengisian;
    document.getElementById('editPersetujuan').value = tanggal_persetujuan;
    document.getElementById('editStatus').value = status;
    document.getElementById('editTotalSks').value = total_sks;
    document.getElementById('editCatatan').value = catatan;
    document.getElementById('editDosenId').value = dosenPa;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateKrs(){
    const id = document.getElementById('editId').value;
    const NewMahasiswa = document.getElementById('editMahasiswaId').value;
    const NewSemester = document.getElementById('editSemesterId').value;
    const NewPengisian = document.getElementById('editPengisian').value;
    const NewPersetujuan = document.getElementById('editPersetujuan').value;
    const NewStatus = document.getElementById('editStatus').value;
    const NewSks = document.getElementById('editTotalSks').value;
    const NewCatatan = document.getElementById('editCatatan').value;
    const NewDosen = document.getElementById('editDosenId').value;
    if(!NewSemester){return alert("Semester Tidak Boleh Kosong")};
    if(!NewPengisian){return alert("Tanggal Pengisian Tidak Boleh Kosong")};
    if(!NewStatus){return alert("Status Tidak Boleh Kosong")};
    if(!NewSks){return alert("Total SKS Boleh Kosong")};
    if(!NewCatatan){return alert("Catatan Tidak Boleh Kosong")};
    if(!NewDosen){return alert("Dosen PA Tidak Boleh Kosong")};
    if(!NewMahasiswa) return alert("mahasiswa Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateKrs(id: ${id}, input:{mahasiswa_id: ${NewMahasiswa}, semester_id: ${NewSemester}, tanggal_pengisian: "${NewPengisian}", tanggal_persetujuan: "${NewPersetujuan}", status: "${NewStatus}", total_sks: ${NewSks}, catatan: "${NewCatatan}", dosen_pa_id: ${NewDosen}}){
                mahasiswa_id
                semester_id
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        alert('Data KHS berhasil diupdate!');
        closeEditModal();
        loadKrsData();

    }
}