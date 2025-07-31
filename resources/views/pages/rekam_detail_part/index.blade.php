@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Part</h1>
        <a href="{{ route('rekam_detail_part.create') }}" class="btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus-circle mr-1"></i>Tambah hasil pekerjaan & komponen yang diganti
</a>
    </div>
 
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Hasil Pekerjaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Rekam</th>
                            <th>Suku Cadang</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamDetails as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->rekam_id }}</td>
                            <td>{{ $item->sukuCadang->nama_barang ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->subtotal }}</td>
                            <td>
                            <a href="{{ route('rekam_detail_part.edit', $item->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit mr-1"></i>Edit
</a>
<form action="{{ route('rekam_detail_part.destroy', $item->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
        <i class="fas fa-trash mr-1"></i>Hapus
    </button>
</form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<link href="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('addon-script')
<script src="{{ url('') }}/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
