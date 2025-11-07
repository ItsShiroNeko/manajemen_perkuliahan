function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    // Reset form
    document.getElementById('addKode').value = '';
    document.getElementById('addFakultas').value = '';
    document.getElementById('addDekan').value = '';
    document.getElementById('addAlamat').value = '';
    document.getElementById('addTelepon').value = '';
    document.getElementById('addEmail').value = '';
}

async function createFakultas(){
    const kode = document.getElementById('addKode').value;
    const nama = document.getElementById('addFakultas').value;
    const dekan = document.getElementById('addDekan').value;
    const alamat = document.getElementById('addAlamat').value;
    const telepon = document.getElementById('addTelepon').value;
    const email = document.getElementById('addEmail').value;
    
    // Validasi
    if (!kode) return alert("Kode Fakultas Harus Diisi!");
    if (!nama) return alert("Nama Fakultas Harus Diisi!");
    if (!dekan) return alert("Dekan Harus Diisi!");
    if (!telepon) return alert("Nomer Telepon Harus Diisi!");
    if (!email) return alert("Email Harus Diisi!");
    
    try {
        const mutation = `
        mutation {
            createFakultas(input: {
                kode_fakultas: "${kode}", 
                nama_fakultas: "${nama}", 
                dekan: "${dekan}", 
                alamat: "${alamat}", 
                telepon: "${telepon}", 
                email: "${email}"
            }){
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
            alert('Gagal menambah data: ' + result.errors[0].message);
            return;
        }
        
        alert('Data fakultas berhasil ditambahkan!');
        closeAddModal();
        loadFakultasData(); // Pastikan fungsi ini ada untuk reload data
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambah data');
    }
}