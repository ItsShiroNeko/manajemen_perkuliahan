async function fetchRoles() {
    const query = `
        query {
            allRole {
                id
                nama_role
            }
        }`;

    const res = await fetch('/graphql', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({query})
    });

    const { data } = await res.json();
    const select = document.getElementById('editRole');
    select.innerHTML = '<option value="">-- Pilih Role --</option>';
    data.allRole.forEach(role => {
        const opt = document.createElement('option');
        opt.value = role.id;
        opt.textContent = role.nama_role;
        select.appendChild(opt);
    });
}

function openEditModal(id, username, email, role_id, status){
    document.getElementById('editId').value = id;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value = email;
    document.getElementById('editStatus').value = status;

    // Fetch role dari GraphQL sebelum tampilkan modal
    fetchRoles().then(() => {
        document.getElementById('editRole').value = role_id;
        document.getElementById('modalEdit').classList.remove('hidden');
    });
}

function closeEditModal(){
    document.getElementById('modalEdit').classList.add('hidden');
}

async function updateUser(){
    const id = document.getElementById('editId').value;
    const newUsername = document.getElementById('editUsername').value;
    const newEmail = document.getElementById('editEmail').value;
    const newRole = document.getElementById('editRole').value;
    const newStatus = document.getElementById('editStatus').value;

    if(!newUsername) return alert("Username tidak boleh kosong");
    if(!newEmail) return alert("Email tidak boleh kosong");
    if(!newRole) return alert("Role belum dipilih");
    if(!newStatus) return alert("Status belum dipilih");

    const mutation = `
        mutation {
            updateUser(
                id: ${id},
                input: {
                    username: "${newUsername}",
                    email: "${newEmail}",
                    role_id: ${newRole},
                    status: "${newStatus}"
                }
            ) {
                id
                username
                email
                role_id
                status
            }
        }`;

    const res = await fetch('/graphql', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ query: mutation })
    });

    const result = await res.json();
    if(result.errors) {
        console.error(result.errors);
        alert("Gagal memperbarui user");
        return;
    }
    alert("Berhasil Mengedit User")

    closeEditModal();
    loadUser(); // Refresh data user setelah update
}