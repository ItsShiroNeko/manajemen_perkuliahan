function openEditModal(id, kode, nama, dekan, alamat, telepon, email){
    document.getElementById('editId').value = id;
    document.getElementById('editKode').value = kode;
    document.getElementById('editFakultas').value = nama;
    document.getElementById('editDekan').value = dekan;
    document.getElementById('editAlamat').value = alamat;
    document.getElementById('editTelepon').value = telepon;
    document.getElementById('editEmail').value = email;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateFakultas(){
    const id = document.getElementById('editId').value;
    const kode = document.getElementById('editKode').value;
    const nama = document.getElementById('editFakultas').value;
    const dekan = document.getElementById('editDekan').value;
    const alamat = document.getElementById('editAlamat').value;
    const telepon = document.getElementById('editTelepon').value;
    const email = document.getElementById('editEmail').value;
    
    // Validasi
    if (!kode) return alert("Kode Fakultas Tidak Boleh Kosong");
    if (!nama) return alert("Nama Fakultas Tidak Boleh Kosong");
    if (!dekan) return alert("Dekan Tidak Boleh Kosong");
    if (!telepon) return alert("Nomer Telepon Tidak Boleh Kosong");
    if (!email) return alert("Email Tidak Boleh Kosong");
    
    try {
        const mutation = `
        mutation {
            updateFakultas(
                id: ${id}, 
                input: {
                    kode_fakultas: "${kode}", 
                    nama_fakultas: "${nama}", 
                    dekan: "${dekan}", 
                    alamat: "${alamat}", 
                    telepon: "${telepon}", 
                    email: "${email}"
                }
            ){
                id
                kode_fakultas
                nama_fakultas
                dekan
                alamat
                telepon
                email
            }
        }`;
        
        const response = await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        
        const result = await response.json();
        
        if (result.errors) {
            console.error('GraphQL Errors:', result.errors);
            alert('Gagal mengupdate data: ' + result.errors[0].message);
            return;
        }
        
        alert('Data fakultas berhasil diupdate!');
        closeEditModal();
        loadFakultasData();
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate data');
    }
}