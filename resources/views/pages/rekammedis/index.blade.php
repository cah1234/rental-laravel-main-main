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
                            <th>No Telpon</th>
                            <th>Nomor Rangka</th>
                            <th>Jenis Mobil</th>
                            <th>Nama Customer</th>
                            <th>Masalah Kerusakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->no_telpon }}</td>
                            <td>{{ $row->nomor_rangka }}</td>
                            <td>{{ $row->jenis_mobil }}</td>
                            <td>{{ $row->nama_customer }}</td>
                            <td>{{ $row->masalah_kerusakan }}</td>
                            <td><a href="{{ route('rekammedis.show', $row->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <br>
                            <a href="{{ route('rekammedis.show', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <br>
                            <form action="{{ route('rekammedis.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>

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
                @foreach([
                    ['name'=>'date','label'=>'Tanggal','type'=>'date'],
                    ['name'=>'no_telpon','label'=>'No Telpon','type'=>'text'],
                    ['name'=>'nomor_rangka','label'=>'Nomor Rangka','type'=>'text'],
                    ['name'=>'nomor_polisi','label'=>'Nomor Polisi','type'=>'text'],
                    ['name'=>'jenis_mobil','label'=>'Jenis Mobil','type'=>'text'],
                    ['name'=>'nama_customer','label'=>'Nama Customer','type'=>'text'],
                    ['name'=>'masalah_kerusakan','label'=>'Masalah Kerusakan','type'=>'textarea'],
                    ['name'=>'service_bulanan_balancing','label'=>'Service Bulanan Balancing','type'=>'select','options'=>[''=>'-- Pilih --','oli'=>'Oli','freon ac'=>'Freon AC','whiper'=>'Whiper','kaca'=>'Kaca','ban'=>'Ban','spooring'=>'Spooring']],
                    ['name'=>'uraian','label'=>'Uraian','type'=>'textarea'],
                    ['name'=>'tanggal_kerusakan','label'=>'Tanggal Kerusakan','type'=>'date'],
                    ['name'=>'dimana','label'=>'Dimana','type'=>'select','options'=>[''=>'-- Pilih --','tanajakan'=>'Tanjakan','turunan'=>'Turunan','jalan_lurus'=>'Jalan Lurus','bergelombang'=>'Bergelombang']],
                    ['name'=>'estimasi','label'=>'Estimasi','type'=>'text'],
                ] as $input)
                    <div class="form-group">
                        <label>{{ $input['label'] }}</label>
                        @if($input['type']=='textarea')
                            <textarea name="{{ $input['name'] }}" class="form-control"></textarea>
                        @elseif($input['type']=='select')
                            <select name="{{ $input['name'] }}" class="form-control">
                                @foreach($input['options'] as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
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
