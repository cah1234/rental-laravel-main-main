@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Pekerjaan</h1>
        @if (count($teknisis) > 0 && $teknisis[0]->order_id)
        <a href="{{ route('hasil_kerja.form', ['order_id' => $teknisis[0]->order_id]) }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i> Tambah Hasil Pekerjaan
        </a>
        @endif
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
                            <th>Hasil Pekerjaan</th>
                            <th>Suku Cadang Diganti</th>
                            <th>Jumlah</th>
                            <th>Saran</th>
                            <th>Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teknisis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->hasil_pekerjaan }}</td>
                            <td>{{ $item->suku_cadang_diganti ?? '-' }}</td>
                            <td>{{ $item->jumlah_suku_cadang_diganti }}</td>
                            <td>{{ $item->saran }}</td>
                            <td>
                                <span class="badge badge-{{ $item->verifikasi == 'Sudah' ? 'success' : 'warning' }}">
                                    {{ $item->verifikasi }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('hasil_kerja.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('hasil_kerja.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @if ($item->order_id)
                                <a href="{{ route('hasil_kerja.form', ['order_id' => $item->order_id]) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-wrench"></i>
                                </a>
                                @endif
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