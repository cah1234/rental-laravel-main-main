@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Akun {{ $user->name }}</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit</h6>
                </div>
                <div class="card-body">
                <form action="{{ route('users.update', ['user' => $user->user_id]) }}" method="POST">
                @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password (kosongkan jika tidak diubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                        <label for="created_at">Created At (kosongkan jika tidak diubah)</label>
                        <input type="datetime-local" class="form-control @error('created_at') is-invalid @enderror"
                            id="created_at" name="created_at"
                            value="{{ old('created_at', $user->created_at ? $user->created_at->format('Y-m-d\TH:i') : '') }}">
                        @error('created_at')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>


                        <div class="mt-3">
                            <button class="btn btn-primary">Edit</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali ke Beranda</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
