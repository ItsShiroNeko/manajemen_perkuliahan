// === MODAL ADD USER ===
function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
    fetchRolesAdd(); // ambil data role saat modal dibuka
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
}

// Ambil Role untuk dropdown di Modal Add
async function fetchRolesAdd() {
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
    const select = document.getElementById('addRole');
    select.innerHTML = '<option value="">-- Pilih Role --</option>';
    data.allRole.forEach(role => {
        const opt = document.createElement('option');
        opt.value = role.id;
        opt.textContent = role.nama_role;
        select.appendChild(opt);
    });
}

// Kirim data tambah user ke GraphQL
async function createUser(){
    const username = document.getElementById('addUsername').value;
    const email = document.getElementById('addEmail').value;
    const password = document.getElementById('addPassword').value;
    const role = document.getElementById('addRole').value;
    const status = document.getElementById('addStatus').value;

    if(!username) return alert("Username tidak boleh kosong");
    if(!email) return alert("Email tidak boleh kosong");
    if(!password) return alert("Password tidak boleh kosong");
    if(!role) return alert("Role belum dipilih");
    if(!status) return alert("Status belum dipilih");

    const mutation = `
        mutation {
            createUser(input: {
                username: "${username}",
                email: "${email}",
                password: "${password}",
                role_id: ${role},
                status: "${status}"
            }) {
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
    if(result.errors){
        console.error(result.errors);
        alert("Gagal menambahkan user");
        return;
    }
    alert("Berhasil Menambahkan User")

    closeAddModal();
    loadUser();
}
