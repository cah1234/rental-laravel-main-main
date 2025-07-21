@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Hasil Pekerjaan</h2>

    <form action="{{ route('hasil_kerja.update', $hasil->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="hasil_pekerjaan" class="form-label">Hasil Pekerjaan</label>
            <input type="text" name="hasil_pekerjaan" class="form-control" value="{{ old('hasil_pekerjaan', $hasil->hasil_pekerjaan) }}" required>
        </div>

        <div class="mb-3">
            <label for="suku_cadang_diganti" class="form-label">Suku Cadang Diganti</label>
            <input type="text" name="suku_cadang_diganti" class="form-control" value="{{ old('suku_cadang_diganti', $hasil->suku_cadang_diganti) }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_suku_cadang_diganti" class="form-label">Jumlah</label>
            <input type="number" name="jumlah_suku_cadang_diganti" class="form-control" value="{{ old('jumlah_suku_cadang_diganti', $hasil->jumlah_suku_cadang_diganti) }}" required>
        </div>

        <div class="mb-3">
            <label for="saran" class="form-label">Saran</label>
            <textarea name="saran" class="form-control">{{ old('saran', $hasil->saran) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="verifikasi" class="form-label">Verifikasi</label>
            <select name="verifikasi" class="form-select" required>
                <option value="belum_selesai" {{ $hasil->verifikasi === 'belum_selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="selesai" {{ $hasil->verifikasi === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('hasil_kerja.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
