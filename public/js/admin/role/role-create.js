function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addRole').value = '';
    document.getElementById('addRoleDeskripsi').value = '';
}

async function createRole(){
    const role = document.getElementById('addRole').value;
    const deskripsi = document.getElementById('addRoleDeskripsi').value;
    if (!deskripsi) return alert("Deskripsi Role Harus Diisi!");
    if (!role) return alert("Nama Role Harus Diisi!");{
        const mutation =`
        mutation {
            createRole(input: {nama_role: "${role}", deskripsi: "${deskripsi}"}){
                id
                nama_role
                deskripsi
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        closeAddModal();
        loadRoleData();
    }
}