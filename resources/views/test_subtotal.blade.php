@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    @php
        $suku_cadang = collect([
            (object)['id' => 1, 'nama_barang' => 'Filter Oli', 'harga' => 75000.00],
            (object)['id' => 2, 'nama_barang' => 'Kampas Rem', 'harga' => 125000.50],
        ]);
        $hargaMap = $suku_cadang->pluck('harga', 'id');
    @endphp

    <input type="hidden" id="hargaMapData" value='@json($hargaMap)'>

    <div class="mb-3">
        <label for="suku_cadang_id" class="form-label">Komponen</label>
        <select id="suku_cadang_id" class="form-control">
            <option value="">-- Pilih Komponen --</option>
            @foreach ($suku_cadang as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }} - Rp {{ number_format($item->harga, 0, ',', '.') }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah</label>
        <input type="number" id="jumlah" class="form-control" value="1" min="1">
    </div>

    <div class="mb-3">
        <label for="subtotal_display" class="form-label">Subtotal</label>
        <input type="text" id="subtotal_display" class="form-control" readonly>
        <input type="hidden" id="subtotal">
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hargaMapRaw = document.getElementById("hargaMapData").value;
        console.log("Raw JSON from Blade:", hargaMapRaw);

        const hargaMap = JSON.parse(hargaMapRaw);

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

            console.log("Selected ID:", selectedId);
            console.log("Jumlah:", jumlah);
            console.log("Harga Map:", hargaMap);
            console.log("Harga dari Map:", hargaMap[selectedId]);

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
        updateSubtotal(); // run awal
    });
</script>
@endsection
