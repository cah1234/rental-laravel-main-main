document.addEventListener("DOMContentLoaded", function () {
    const hargaMap = JSON.parse(document.getElementById("hargaMapData").value);

    const sukuCadangSelect = document.getElementById("suku_cadang_id");
    const jumlahInput = document.getElementById("jumlah");
    const subtotalDisplay = document.getElementById("subtotal_display");
    const subtotalHidden = document.getElementById("subtotal");

    function formatRupiah(number) {
        return "Rp " + number.toLocaleString("id-ID", { minimumFractionDigits: 0 });
    }

    function updateSubtotal() {
        const selectedId = sukuCadangSelect.value;
        const jumlah = parseInt(jumlahInput.value) || 0;

        if (selectedId && hargaMap[selectedId]) {
            const harga = parseFloat(hargaMap[selectedId]);
            const subtotal = harga * jumlah;

            subtotalDisplay.value = formatRupiah(subtotal);
            subtotalHidden.value = subtotal;
        } else {
            subtotalDisplay.value = '';
            subtotalHidden.value = '';
        }
    }

    sukuCadangSelect.addEventListener('change', updateSubtotal);
    jumlahInput.addEventListener('input', updateSubtotal);
    updateSubtotal();
});
