async function loadDashboard (){
    const query = `
    query(id:$id) {
        mahasiswa(id: $id){
          id
          nama_lengkap
          jurusan {
            id
            nama_jurusan
            fakultas{
              id
              nama_fakultas
            }
          }
          krs{
            id
            tanggal_pengisian
            semester{
              id
              nama_semester
            }
            krsDetail{
              id
              kelas{
                id
                nama_kelas
              }
              mataKuliah{
                id
                nama_mk
              }
            }
          }
          khs {
            id
            mahasiswa{
              nama_lengkap
            }
            sks_semester 
          }
          user {
            id
            role{
              id
            }
          }
        }
      }
    `;
    try{
        const response = await fetch(API_URL,{
            method: 'POST',
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(mahasiswa)
        })
    }
}