@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Rekam Medis</h2>

    <form action="{{ route('rekammedis.update', $item->rekam_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Kendaraan -->
        <div class="form-group">
            <label for="kendaraan_id">Kendaraan</label>
            <select name="kendaraan_id" class="form-control">
                @foreach($kendaraans as $id => $no_polisi)
                    <option value="{{ $id }}" {{ $item->kendaraan_id == $id ? 'selected' : '' }}>
                        {{ $no_polisi }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Servis dari Database -->
        <div class="form-group">
            <label for="tanggal_servis">Tanggal Servis</label>
            <select name="tanggal_servis" class="form-control">
                @foreach($tanggalList as $tanggal)
                    <option value="{{ $tanggal }}" {{ $item->tanggal_servis == $tanggal ? 'selected' : '' }}>
                        {{ $tanggal }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Keluhan -->
        <div class="form-group">
            <label for="keluhan">Keluhan</label>
            <textarea name="keluhan" class="form-control">{{ $item->keluhan }}</textarea>
        </div>

        <!-- Tindakan Servis -->
        <div class="form-group">
            <label for="tindakan_servis">Tindakan Servis</label>
            <textarea name="tindakan_servis" class="form-control">{{ $item->tindakan_servis }}</textarea>
        </div>

        <!-- Status Servis -->
        <div class="form-group">
            <label for="status_servis">Status Servis</label>
            <select name="status_servis" class="form-control">
                <option value="Selesai" {{ $item->status_servis == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Dalam Proses" {{ $item->status_servis == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                <option value="Dibatalkan" {{ $item->status_servis == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <!-- Tombol -->
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('rekammedis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
