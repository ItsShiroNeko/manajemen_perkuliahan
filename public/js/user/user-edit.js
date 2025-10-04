function openEditModal(id, username, email, role_id, status){
    document.getElementById('editId').value = id;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role_id;
    document.getElementById('editStatus').value = status;
    document.getElementById('modalEdit').classList.remove('hidden');
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateRole(){
    const id = document.getElementById('editId').value;
    const newUsername = document.getElementById('editUsername').value;
    const newEmail = document.getElementById('editEmail').value;
    const newRole = document.getElementById('editRole').value;
    const newStatus = document.getElementById('editStatus').value;
    if(!newUsername) return alert("Username Tidak Boleh Kosong");
    if(!newEmail) return alert("Email Tidak Boleh Kosong");
    if(!newStatus) return alert("Status Tidak Boleh Kosong");
    if(!newRole) return alert("Nama Role Tidak Boleh Kosong"); {
        const mutation = `
        mutation {
            updateUser(input: {id: ${id}, username: "${newUsername}", email: "${newEmail}", role_id: "${newRole}", status: "${newStatus}"}){
                id
                username
                email
                role_id
                status
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        closeEditModal();
        loadUser();

    }
}