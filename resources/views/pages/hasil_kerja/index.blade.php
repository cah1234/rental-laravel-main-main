@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Hasil Pekerjaan</h1>

    {{-- Tombol Tambah Hasil Pekerjaan (gunakan id manual atau data valid) --}}
    @if (count($teknisis) > 0 && $teknisis[0]->order_id)
        <a href="{{ route('hasil_kerja.form', ['order_id' => $teknisis[0]->order_id]) }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Tambah Hasil Pekerjaan
        </a>
    @else
        <div class="alert alert-warning">
            Tidak ada data order_id yang tersedia untuk tambah hasil pekerjaan.
        </div>
    @endif

    {{-- Tabel Hasil Pekerjaan --}}
    <table class="table table-bordered">
        <thead class="thead-dark">
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
            @foreach ($teknisis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->hasil_pekerjaan }}</td>
                    <td>{{ $item->suku_cadang_diganti ?? '-' }}</td>
                    <td>{{ $item->jumlah_suku_cadang_diganti }}</td>
                    <td>{{ $item->saran }}</td>
                    <td>{{ $item->verifikasi }}</td>
                    <td>
                        <a href="{{ route('hasil_kerja.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('hasil_kerja.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>

                        @if ($item->order_id)
                            <a href="{{ route('hasil_kerja.form', ['order_id' => $item->order_id]) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-wrench"></i> Isi Hasil
                            </a>
                        @else
                            <span class="text-muted">Order ID tidak tersedia</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
