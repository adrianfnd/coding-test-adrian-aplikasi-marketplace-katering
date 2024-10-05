@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Profil</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="text-center mb-4">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="img-thumbnail rounded-circle" width="150" height="150">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Profile Image" class="img-thumbnail rounded-circle" width="150" height="150">
                            @endif
                        </div>
                        <div class="mb-3 text-center">
                            <label for="profile_image" class="form-label">Ganti Foto Profil</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ auth()->user()->nama_perusahaan }}">
                                @if ($errors->has('nama_perusahaan'))
                                    <p class="text-danger">{{ $errors->first('nama_perusahaan') }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            @if (auth()->user()->role == 'Customer')
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ auth()->user()->alamat }}">
                                    @if ($errors->has('alamat'))
                                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" name="kontak" value="{{ auth()->user()->kontak }}">
                                @if ($errors->has('kontak'))
                                    <p class="text-danger">{{ $errors->first('kontak') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Perusahaan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ auth()->user()->deskripsi }}</textarea>
                            @if ($errors->has('deskripsi'))
                                <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                            @endif
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
