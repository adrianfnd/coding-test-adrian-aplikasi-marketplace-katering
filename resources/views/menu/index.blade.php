@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Menu</h3>
        <div class="card-tools">
            <a href="{{ route('menu.create') }}" class="btn btn-primary btn-sm">Tambah Menu</a>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Menu</th>
                    <th>Nama Menu</th>
                    <th>Deskripsi</th>
                    <th>Jenis Makanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $index => $menu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                      <center>
                        @if ($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama }}" width="75">
                        @else
                            Tidak ada foto
                        @endif
                      </center>
                    </td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->deskripsi }}</td>
                    <td>{{ $menu->jenisMakanan->nama_jenis_makanan }}</td>
                    <td>Rp. {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
      {{ $menus->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
