@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus-circle"></i> Tambah Pelanggan
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($pelanggans as $pelanggan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $pelanggan->nama_pelanggan ?? '-' }}</td>
            <td>{{ $pelanggan->no_telepon ?? '-' }}</td>
            <td>{{ $pelanggan->email ?? '-' }}</td>
            <td>{{ optional($pelanggan->created_at)->format('d-m-Y') }}</td>
            <td>{{ $pelanggan->alamat ?? '-' }}</td>
            <td>
                <a href="{{ route('pelanggan.show', $pelanggan->pelanggan_id) }}" class="btn btn-info btn-sm">Lihat
                </a>
                <a href="{{ route('pelanggan.edit', $pelanggan->pelanggan_id) }}" class="btn btn-warning btn-sm"> Edit
                </a>
                <form action="{{ route('pelanggan.destroy', $pelanggan->pelanggan_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">Data pelanggan tidak ditemukan.</td></tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @foreach([
                    ['name'=>'nama_pelanggan','label'=>'Nama Pelanggan','type'=>'text'],
                    ['name'=>'no_telepon','label'=>'No Telepon','type'=>'text'],
                    ['name'=>'email','label'=>'Email','type'=>'email'],
                    ['name'=>'alamat','label'=>'Alamat','type'=>'textarea'],
                ] as $input)
                    <div class="form-group">
                        <label>{{ $input['label'] }}</label>
                        @if($input['type']=='textarea')
                            <textarea name="{{ $input['name'] }}" class="form-control"></textarea>
                        @else
                            <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="form-control">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
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
<script src="{{ url('') }}/dashboard/js/demo/datatables-demo.js"></script>
@endpush
