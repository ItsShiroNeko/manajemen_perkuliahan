function openEditModal(id, kode, semester, tahun, periode, mulai, selesai){
    document.getElementById('editId').value = id;
    document.getElementById('editKode').value = kode;
    document.getElementById('editSemester').value = semester;
    document.getElementById('editTahun').value = tahun;
    document.getElementById('editPeriode').value = periode;
    document.getElementById('editMulai').value = mulai;
    document.getElementById('editSelesai').value = selesai;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateSemester(){
    const id = document.getElementById('editId').value;
    const NewKode = document.getElementById('editKode').value;
    const NewSemester = document.getElementById('editSemester').value;
    const NewTahun = document.getElementById('editTahun').value;
    const NewPeriode = document.getElementById('editPeriode').value;
    const NewMulai = document.getElementById('editMulai').value;
    const NewSelesai = document.getElementById('editSelesai').value;
    if(!NewSemester){return alert("Nama Semester Tidak Boleh Kosong")};
    if(!NewTahun){return alert("Tahun Semester Tidak Boleh Kosong")};
    if(!NewPeriode){return alert("Periode Semester Tidak Boleh Kosong")};
    if(!NewMulai){return alert("Tanggal Mulai Semester Tidak Boleh Kosong")};
    if(!NewSelesai){return alert("Tanggal Selesai Semester Tidak Boleh Kosong")};
    if(!NewKode) return alert("Kode Semester Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateSemester(id: ${id}, input:{kode_semester: "${NewKode}", nama_semester: "${NewSemester}", tahun_ajaran: "${NewTahun}", periode: "${NewPeriode}", tanggal_mulai: "${NewMulai}", tanggal_selesai: "${NewSelesai}"}){
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
        closeEditModal();
        loadSemesterData();

    }
}