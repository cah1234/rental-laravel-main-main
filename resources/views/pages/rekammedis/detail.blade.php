@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <a href="javascript:history.back()" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <table class="table table-bordered">
                <tbody>
                    <tr><td>Tanggal</td><td>{{ $item->date }}</td></tr>
                    <tr><td>No Telpon</td><td>{{ $item->no_telpon }}</td></tr>
                    <tr><td>Nomor Rangka</td><td>{{ $item->nomor_rangka }}</td></tr>
                    <tr><td>Jenis Mobil</td><td>{{ $item->jenis_mobil }}</td></tr>
                    <tr><td>Nama Customer</td><td>{{ $item->nama_customer }}</td></tr>
                    <tr><td>Masalah Kerusakan</td><td>{{ $item->masalah_kerusakan }}</td></tr>
                    <tr><td>Service Bulanan Balancing</td><td>{{ $item->service_bulanan_balancing }}</td></tr>
                    <tr><td>Uraian</td><td>{{ $item->uraian }}</td></tr>
                    <tr><td>Tanggal Kerusakan</td><td>{{ $item->tanggal_kerusakan }}</td></tr>
                    <tr><td>Jenis Jalan</td><td>{{ $item->dimana }}</td></tr>
                    <tr><td>Estimasi</td><td>{{ $item->estimasi }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
