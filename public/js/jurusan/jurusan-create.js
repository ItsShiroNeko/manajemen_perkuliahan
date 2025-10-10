async function openAddModal(){
    await loadFakultasOptions();
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    // Reset form
    document.getElementById('addKode').value = '';
    document.getElementById('addNama').value = '';
    document.getElementById('addFakultasId').value = '';
    document.getElementById('addJenjang').value = '';
    document.getElementById('addAkreditasi').value = '';
    document.getElementById('addKaprodi').value = '';
}

async function createJurusan(){
    const kode = document.getElementById('addKode').value;
    const nama = document.getElementById('addNama').value;
    const fakultasId = document.getElementById('addFakultasId').value;
    const jenjang = document.getElementById('addJenjang').value;
    const akreditasi = document.getElementById('addAkreditasi').value;
    const kaprodi = document.getElementById('addKaprodi').value;
    
    // Validasi
    if (!kode) return alert("Kode Jurusan Harus Diisi!");
    if (!nama) return alert("Nama Jurusan Harus Diisi!");
    if (!fakultasId) return alert("Fakultas Harus Diisi!");
    if (!jenjang) return alert("Jenjang Harus Diisi!");
    if (!akreditasi) return alert("Akreditasi Harus Diisi!");
    if (!kaprodi) return alert("Kaprodi Harus Diisi!");
    
    try {
        const mutation = `
        mutation {
            createJurusan(input: {
                kode_jurusan: "${kode}", 
                nama_jurusan: "${nama}", 
                fakultas_id: ${fakultasId}, 
                jenjang: "${jenjang}", 
                akreditasi: "${akreditasi}", 
                kaprodi: "${kaprodi}"
            }){
                id
                kode_jurusan
                nama_jurusan
                fakultas_id
                jenjang
                akreditasi
                kaprodi
            }
        }`;
        
        const response = await fetch(API_URL, {
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
        
        alert('Data jurusan berhasil ditambahkan!');
        closeAddModal();
        loadJurusanData();
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menambah data');
    }
}