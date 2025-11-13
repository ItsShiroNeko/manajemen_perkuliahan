function openEditModal(id, role, deskripsi){
    document.getElementById('editId').value = id;
    document.getElementById('editRole').value = role;
    document.getElementById('editRoleDeskripsi').value = deskripsi;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateRole(){
    const id = document.getElementById('editId').value;
    const newRole = document.getElementById('editRole').value;
    const newRoleDesk = document.getElementById('editRoleDeskripsi').value;
    if(!newRole) return alert("Nama Role Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateRole(id: ${id}, input:{nama_role: "${newRole}" deskripsi: "${newRoleDesk}"}){
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
        closeEditModal();
        loadRoleData();

    }
}