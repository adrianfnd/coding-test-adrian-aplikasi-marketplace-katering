@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Tambah Menu
    </div>
    <div class="card-body">
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="masukan nama menu disini...">
                @if ($errors->has('nama'))
                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Menu</label>
                <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi">{{ old('deskripsi') }}</textarea>
                @if ($errors->has('deskripsi'))
                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="jenis_makanan" class="form-label">Jenis Makanan</label>
                <select class="form-select" id="jenis_makanan" name="jenis_makanan">
                    <option selected disabled>Pilih Jenis Makanan</option>
                    @foreach ($jenisMakanan as $makanan)
                        <option value="{{ $makanan->id }}" {{ old('jenis_makanan') == $makanan->id ? 'selected' : '' }}>{{ $makanan->nama_jenis_makanan }}</option>
                    @endforeach
                </select>
                @if ($errors->has('jenis_makanan'))
                    <p class="text-danger">{{ $errors->first('jenis_makanan') }}</p>
                @endif
            </div>        
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" placeholder="masukan harga menu disini...">
                @if ($errors->has('harga'))
                    <p class="text-danger">{{ $errors->first('harga') }}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Menu</label>
                <input class="form-control" type="file" id="foto" name="foto">
                @if ($errors->has('foto'))
                    <p class="text-danger">{{ $errors->first('foto') }}</p>
                @endif
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </form>
    </div>
  </div>
@endsection
