@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pelanggan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="javascript:history.back()" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <table class="table table-bordered">
            @extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Detail Pelanggan</h1>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Nama Pelanggan</td>
                <td>{{ $pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>{{ $pelanggan->no_telepon }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $pelanggan->email }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $pelanggan->alamat }}</td>
            </tr>
            <tr>
                <td>Dibuat Pada</td>
                <td>{{ $pelanggan->created_at }}</td>
            </tr>
            <tr>
                <td>Terakhir Diubah</td>
                <td>{{ $pelanggan->updated_at }}</td>
            </tr>
            <tr>
        </tbody>
    </table>
    {{-- Tombol Kembali --}}
    <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
@endsection
            </table>
        </div>
    </div>

</div>
@endsection
