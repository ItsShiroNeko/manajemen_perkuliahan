const API_URL = "/graphql";
let currentKrsId = null;
let currentKrsData = null;

// Ambil ID dari URL
function getKrsIdFromUrl() {
    const path = window.location.pathname;
    const segments = path.split('/');
    return segments[segments.length - 1]; // Ambil segment terakhir (id)
}
