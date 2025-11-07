function openAddModal(){
    document.getElementById('modalAdd').classList.remove('hidden');
}

function closeAddModal(){
    document.getElementById('modalAdd').classList.add('hidden');
    document.getElementById('addUsername').value = '';
    document.getElementById('addEmail').value = '';
    document.getElementById('addPassword').value = '';
    document.getElementById('addRole').value = '';
    document.getElementById('addStatus').value = '';
}

async function createUser(){
    const role = document.getElementById('addRole').value;
    const username = document.getElementById('addUsername').value;
    const password = document.getElementById('addPassword').value;
    const email = document.getElementById('addEmail').value;
    const status = document.getElementById('addStatus').value;
    if (!username) return alert("Username Role Harus Diisi!");
    if (!password) return alert("Password Role Harus Diisi!");
    if (!email) return alert("Email Role Harus Diisi!");
    if (!status) return alert("Status Role Harus Diisi!");
    if (!role) return alert("Nama Role Harus Diisi!");{
        const mutation =`
        mutation {
            createRole(input: {username: "${username}", password: "${password}", email: "${email}", role_id: "${role}", status: "${status}"}){
                id
                username
                password
                email
                status
                role_id
            }
        }`;
        await fetch('/graphql', {
            method: 'POST',
            headers: {'Content-Type' : 'application/json'},
            body: JSON.stringify({query: mutation})
        });
        closeAddModal();
        loadUser();
    }
}