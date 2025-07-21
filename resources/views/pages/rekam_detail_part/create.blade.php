@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Form Hasil Pekerjaan</h2>

    <form id="form-pekerjaan" action="{{ route('rekam_detail_part.store') }}" method="POST">
        @csrf

        {{-- Rekam ID Dropdown --}}
        <div class="mb-3">
        <label for="rekam_id" class="form-label">Pilih Rekam Medis</label>
        <select name="rekam_id" id="rekam_id" class="form-control" required>
            <option value="" disabled selected>-- Pilih Rekam --</option>
            @foreach ($rekams as $rekam)
                <option value="{{ $rekam->rekam_id }}"
                    {{ old('rekam_id') == $rekam->rekam_id ? 'selected' : '' }}>
                    #{{ $rekam->rekam_id }} - {{ $rekam->kendaraan->jenis_kendaraan }} ({{ $rekam->kendaraan->merk }} - {{ $rekam->kendaraan->nomor_polisi }})
                </option>
            @endforeach
            </select>
        </div>

    {{-- Komponen --}}
    <div class="mb-3">
        <label for="suku_cadang_id" class="form-label">Komponen yang Diganti</label>
        <select name="suku_cadang_id" id="suku_cadang_id" class="form-control" required>
            <option value="" disabled selected>-- Pilih Komponen --</option>
            @foreach ($suku_cadangs as $sc)
                <option 
                    value="{{ $sc->id }}" 
                    data-harga="{{ $sc->harga }}"
                    {{ old('suku_cadang_id') == $sc->id ? 'selected' : '' }}>
                    {{ $sc->nama_barang }}
                </option>
            @endforeach
        </select>
    </div>

    
    {{-- Harga Komponen --}}
    <!-- Harga Komponen -->
    <div class="mb-3">
        <label for="harga_display" class="form-label">Harga Komponen</label>
        <input type="text" id="harga_display" class="form-control" readonly>
        <input type="hidden" name="harga" id="harga">
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKomponen = document.getElementById('suku_cadang_id');
        const inputHarga = document.getElementById('harga');
        const jumlahInput = document.getElementById('jumlah');
        const subtotalInput = document.getElementById('subtotal');
        const subtotalDisplay = document.getElementById('subtotal_display');

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateHargaDanSubtotal() {
            const selectedOption = selectKomponen.options[selectKomponen.selectedIndex];
            const harga = parseInt(selectedOption?.dataset.harga || 0);
            const jumlah = parseInt(jumlahInput.value || 0);
            const total = harga * jumlah;

            document.getElementById('harga_display').value = 'Rp ' + formatRupiah(harga);
            document.getElementById('harga').value = harga; // angka murni, contoh: 25000
            subtotalInput.value = total;
            subtotalDisplay.value = 'Rp ' + formatRupiah(total);
        }

        selectKomponen.addEventListener('change', updateHargaDanSubtotal);
        jumlahInput.addEventListener('input', updateHargaDanSubtotal);

        updateHargaDanSubtotal();
    });
</script>


        {{-- Jumlah --}}
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Diganti</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="{{ old('jumlah', 1) }}" required>
        </div>

        {{-- Subtotal --}}
        <div class="mb-3">
            <label for="subtotal_display" class="form-label">Subtotal (Rp)</label>
            <input type="text" id="subtotal_display" class="form-control" readonly>
            <input type="hidden" name="subtotal" id="subtotal">
        </div>

        {{-- Tombol --}}
        <button type="submit" id="btn-submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Simpan
        </button>

        <a href="{{ route('rekam_detail_part.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
        </div>


{{-- JavaScript langsung di halaman --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Script aktif');

        const form = document.getElementById('form-pekerjaan');
        const btnSubmit = document.getElementById('btn-submit');
        const selectKomponen = document.getElementById('suku_cadang_id');
        const inputHarga = document.getElementById('harga');
        const jumlahInput = document.getElementById('jumlah');
        const subtotalInput = document.getElementById('subtotal');
        const subtotalDisplay = document.getElementById('subtotal_display');

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateHargaDanSubtotal() {
            const selectedOption = selectKomponen.options[selectKomponen.selectedIndex];
            const harga = parseInt(selectedOption?.dataset.harga || 0);
            const jumlah = parseInt(jumlahInput.value || 0);
            const total = harga * jumlah;

            inputHarga.value = 'Rp ' + formatRupiah(harga);
            subtotalInput.value = total;
            subtotalDisplay.value = 'Rp ' + formatRupiah(total);
        }

        if (selectKomponen && jumlahInput) {
            selectKomponen.addEventListener('change', updateHargaDanSubtotal);
            jumlahInput.addEventListener('input', updateHargaDanSubtotal);
            updateHargaDanSubtotal();
        }

        if (btnSubmit) {
            btnSubmit.addEventListener('click', function (e) {
            e.preventDefault(); // cegah submit langsung

            updateHargaDanSubtotal();

            const sukuCadangId = selectKomponen.value;
            const harga = document.getElementById('harga').value;
            const subtotal = subtotalInput.value; {
            }

            form.submit(); // hanya submit jika semua valid
        });
        }
    });
</script>

@endsection