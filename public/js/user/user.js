const API_URL = "/graphql";
let currentPage = 1;

async function loadUser(page = 1) {
    currentPage = page;
    const perPage = document.getElementById("perPage")?.value || 10;
    const searchValue = document.getElementById("search")?.value.trim() || "";

    const query = `
    query($first: Int, $page: Int, $search: String) {
        allUserPaginate(first: $first, page: $page, search: $search) {
            data {
                id
                username
                email
                role_id
                status
                role{
                    nama_role
                }
            }
            paginatorInfo {
                currentPage
                lastPage
                total
                hasMorePages
            }
        }
    }`;

    const variables = { first: parseInt(perPage), page, search: searchValue };

    const res = await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ query, variables })
    });
    const data = await res.json();

    const tbody = document.getElementById("dataUser");
    tbody.innerHTML = "";

    const result = data.data?.allUserPaginate;
    if (!result) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center p-2">Error load data</td></tr>`;
        return;
    }

    const items = result.data;
    const pageInfo = result.paginatorInfo;

    if (!items || items.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center p-2">Data Tidak Ditemukan</td></tr>`;
        document.getElementById("pageInfo").innerText = "Tidak ada data";
        return;
    }

    items.forEach(item => {
        tbody.innerHTML += `
            <tr class="border-b">
                <td class="border px-2 py-1">${item.id}</td>
                <td class="border px-2 py-1">${item.username}</td>
                <td class="border px-2 py-1">${item.email}</td>
                <td class="border px-2 py-1">${item.role.nama_role}</td>
                <td class="border px-2 py-1">${item.status || "-"}</td>
                <td class="border px-2 py-1">
                    <button onclick="openEditModal(${item.id}, '${item.username}', '${item.email}', '${item.role_id}', '${item.status}')" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                    <button onclick="hapusUser(${item.id})" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                </td>
            </tr>
        `;
    });

    document.getElementById("pageInfo").innerText = 
        `Halaman ${pageInfo.currentPage} dari ${pageInfo.lastPage} (Total: ${pageInfo.total})`;

    document.getElementById("prevBtn").disabled = pageInfo.currentPage <= 1;
    document.getElementById("nextBtn").disabled = !pageInfo.hasMorePages;
}

function searchUser() {
    loadUser(1);
}

function prevPage() {
    if (currentPage > 1) loadUser(currentPage - 1);
}

function nextPage() {
    loadUser(currentPage + 1);
}

async function hapusUser(id) {
    if (!confirm("Yakin ingin menghapus data ini?")) return;

    const mutation = `
        mutation {
            deleteUser(id: ${id}) {
                id
            }
        }`;

    await fetch(API_URL, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ query: mutation })
    });

    loadUser(currentPage);
}

document.addEventListener("DOMContentLoaded", () => loadUser());
