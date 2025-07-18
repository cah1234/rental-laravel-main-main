@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Form Hasil Pekerjaan</h2>

    <form action="{{ route('hasil_kerja.store') }}" method="POST">

        @csrf
        <input type="hidden" name="teknisi_id" value="{{ $teknisi->id }}">

        {{-- Hasil Kerja --}}
        <div class="mb-3">
            <label for="hasil_kerja" class="form-label">Hasil Kerja</label>
            <textarea name="hasil_kerja" id="hasil_kerja" class="form-control" rows="4" required></textarea>
        </div>

        {{-- Komponen yang Diganti --}}
        <div class="mb-3">
            <label for="komponen_id" class="form-label">Komponen yang Diganti</label>
            <select name="komponen_id" id="komponen_id" class="form-control" required>
                <option value="">-- Pilih Komponen --</option>
                @foreach ($komponens as $komponen)
                    <option value="{{ $komponen->id }}">{{ $komponen->nama_komponen }}</option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Diganti</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>

        {{-- Saran --}}
        <div class="mb-3">
            <label for="saran" class="form-label">Saran</label>
            <textarea name="saran" id="saran" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
        <a href="{{ route('hasil-pekerjaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
