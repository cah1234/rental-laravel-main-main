@extends('layouts.app') {{-- Sesuaikan dengan layout yang kamu pakai --}}

@section('content')
<div class="container">
    <h2>Form Suku Cadang</h2>
    
    <form action="{{ isset($sukuCadang) ? route('suku_cadang.update', $sukuCadang->id) : route('suku_cadang.store') }}" method="POST">
        @csrf
        @if(isset($sukuCadang))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="suku_cadang_id" class="form-label">ID Suku Cadang</label>
            <input type="text" class="form-control" id="suku_cadang_id" name="suku_cadang_id" value="{{ old('suku_cadang_id', $sukuCadang->suku_cadang_id ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $sukuCadang->nama_barang ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan', $sukuCadang->satuan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $sukuCadang->harga ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $sukuCadang->stock ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($sukuCadang) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection
