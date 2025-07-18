@extends('layouts.dashboard')

@section('content')

<div class="container">
    <h2 class="mb-4">Data Suku Cadang</h2>

    <a href="{{ route('suku_cadang.create') }}" class="btn btn-primary mb-3">Tambah Suku Cadang</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->suku_cadang_id }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <a href="{{ route('suku_cadang.edit', ['suku_cadang' => $item->suku_cadang_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('suku_cadang.destroy', ['suku_cadang' => $item->suku_cadang_id]) }}" method="POST" style="display:inline;">
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
@endsection
