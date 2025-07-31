@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h3>Form Keluhan Pelanggan</h3>

    <form action="{{ route('keluhan.store') }}" method="POST">
        @csrf

        {{-- Keluhan --}}
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required></textarea>
        </div>

        {{-- Komponen yang ingin diganti --}}
        <div class="mb-3">
            <label for="suku_cadang_id" class="form-label">Komponen yang Ingin Diganti</label>
            <select name="suku_cadang_id[]" class="form-control" multiple>
                @foreach ($suku_cadangs as $sc)
                    <option value="{{ $sc->id }}">{{ $sc->nama_barang }}</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Tekan Ctrl (atau Cmd) untuk memilih lebih dari satu komponen.</small>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
    </form>
</div>
@endsection
