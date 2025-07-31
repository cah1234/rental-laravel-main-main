@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Form Hasil Pekerjaan</h2>

    <form action="{{ route('rekam_detail_part.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rekam_id" class="form-label">Pilih Rekam Medis</label>
            <select name="rekam_id" id="rekam_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Rekam --</option>
                @foreach ($rekams as $rekam)
                    <option value="{{ $rekam->rekam_id }}">
                        #{{ $rekam->rekam_id }} - {{ $rekam->kendaraan->jenis_kendaraan }} ({{ $rekam->kendaraan->merk }} - {{ $rekam->kendaraan->nomor_polisi }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="suku_cadang_id" class="form-label">Komponen yang Diganti</label>
            <select name="suku_cadang_id" id="suku_cadang_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Komponen --</option>
                @foreach ($suku_cadang as $sc)
                    <option value="{{ $sc->suku_cadang_id }}" data-harga="{{ $sc->harga }}">
                        {{ $sc->nama_barang }} - Rp {{ number_format($sc->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="harga_display" class="form-label">Harga Komponen</label>
            <input type="text" id="harga_display" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Diganti</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label for="subtotal_display" class="form-label">Subtotal (Rp)</label>
            <input type="text" id="subtotal_display" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('rekam_detail_part.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKomponen = document.getElementById('suku_cadang_id');
        const hargaDisplay = document.getElementById('harga_display');
        const jumlahInput = document.getElementById('jumlah');
        const subtotalDisplay = document.getElementById('subtotal_display');

        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID');
        }

        function updateHargaSubtotal() {
            const selectedOption = selectKomponen.options[selectKomponen.selectedIndex];
            const harga = parseInt(selectedOption.dataset.harga || 0);
            const jumlah = parseInt(jumlahInput.value || 0);
            const subtotal = harga * jumlah;

            hargaDisplay.value = 'Rp ' + formatRupiah(harga);
            subtotalDisplay.value = 'Rp ' + formatRupiah(subtotal);
        }

        selectKomponen.addEventListener('change', updateHargaSubtotal);
        jumlahInput.addEventListener('input', updateHargaSubtotal);

        updateHargaSubtotal();
    });
</script>
@endsection
