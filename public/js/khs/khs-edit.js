async function openEditModal(id, mahasiswa, semester, sks_semester, sks_kumulatif, ip_semester, ipk){
    await loadMahasiswaOptions();
    await loadSemesterOptions(); 
    document.getElementById('editId').value = id;
    document.getElementById('editMahasiswaId').value = mahasiswa;
    document.getElementById('editSemesterId').value = semester;
    document.getElementById('editSksSemester').value = sks_semester;
    document.getElementById('editSksKumulatif').value = sks_kumulatif;
    document.getElementById('editIpSemester').value = ip_semester;
    document.getElementById('editIPK').value = ipk;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateKhs(){
    const id = document.getElementById('editId').value;
    const NewMahasiswa = document.getElementById('editMahasiswaId').value;
    const NewSemester = document.getElementById('editSemesterId').value;
    const NewSksSemester = document.getElementById('editSksSemester').value;
    const NewSksKumulatif = document.getElementById('editSksKumulatif').value;
    const Newipk = document.getElementById('editIPK').value;
    const NewIpSemester = document.getElementById('editIpSemester').value;
    if(!NewSemester){return alert("Semester Tidak Boleh Kosong")};
    if(!NewSksSemester){return alert("sks semester Tidak Boleh Kosong")};
    if(!NewSksKumulatif){return alert("sks kumulatif Tidak Boleh Kosong")};
    if(!NewSemester){return alert("Semester Tidak Boleh Kosong")};
    if(!Newipk){return alert("ipk Tidak Boleh Kosong")};
    if(!NewIpSemester){return alert("ip semester Tidak Boleh Kosong")};
    if(!NewMahasiswa) return alert("mahasiswa Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateKhs(id: ${id}, input:{mahasiswa_id: ${NewMahasiswa}, semester_id: ${NewSemester}, sks_semester: ${NewSksSemester}, sks_kumulatif: ${NewSksKumulatif}, ipk: ${Newipk}, ip_semester: ${NewIpSemester}}){
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
        loadKhsData();

    }
}