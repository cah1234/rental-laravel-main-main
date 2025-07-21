<!-- resources/views/pages/rekammedis/index.blade.php -->
@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekam Medis</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus-circle"></i> Tambah Rekam Medis
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Customer</th>
                            <th>Jenis Mobil</th>
                            <th>Masalah Kerusakan</th>
                            <th>Status Service</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $row)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->tanggal_servis }}</td>
                        <td>{{ optional($row->kendaraan->pelanggan)->nama_pelanggan ?? '-' }}</td>
                        <td>{{ optional($row->kendaraan)->merk ?? '-' }}</td>
                        <td>{{ $row->keluhan }}</td>
                        <td>{{ $row->status_servis ?? '-' }}</td>
                            <td>
                              
                                <a href="{{ route('rekammedis.edit', $row->rekam_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('rekammedis.destroy', $row->rekam_id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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

<div class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ route('rekammedis.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rekam Medis</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Dropdown Nama Pelanggan -->
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Input Nomor Polisi -->
                <div class="form-group">
                    <label>Nomor Polisi</label>
                    <input type="text" name="no_polisi" id="no_polisi" class="form-control" readonly>
                    <input type="hidden" name="kendaraan_id" id="kendaraan_id">
                </div>

                <div class="form-group">
                    <label>Tanggal Servis</label>
                    <input type="date" name="tanggal_servis" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Status Servis</label>
                    <select name="status_servis" class="form-control">
                        <option value="">-- Pilih Status --</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dalam Proses">Dalam Proses</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>

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

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $('#pelanggan_id').on('change', function () {
    let id = $(this).val();
    if (id) {
        $.get('/kendaraan-by-pelanggan/' + id, function(res) {
            $('#no_polisi').val(res.no_polisi || '');
            $('#kendaraan_id').val(res.kendaraan_id || '');
        });
    } else {
        $('#no_polisi').val('');
        $('#kendaraan_id').val('');
    }
});

</script>
@endpush

@push('addon-style')
<link href="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('addon-script')
<script src="{{ url('') }}/dashboard/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/dashboard/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/dashboard/js/demo/datatables-demo.js"></script>
@endpush

