<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\JenisMakanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('merchant', 'jenisMakanan')
                ->where('merchant_id', auth()->user()->id)
                ->get();

        return view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisMakanan = JenisMakanan::all();

        return view('menu.create', compact('jenisMakanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:menus|max:255',
            'deskripsi' => 'required|max:255',
            'jenis_makanan' => 'required',
            'harga' => 'required|numeric|min:1000',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.unique' => 'Nama sudah ada dalam menu.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'jenis_makanan.required' => 'Jenis makanan harus dipilih.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga minimal adalah 1000.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus bertipe jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);        

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('menu-images', 'public');
        }

        $menu = Menu::create([
            'merchant_id' => auth()->user()->id,
            'jenis_makanan_id' => $request->input('jenis_makanan'),
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'foto' => $foto,
            'harga' => $request->input('harga'),
        ]);

        return redirect()->route('menu')->with('success', 'Menu berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:255|unique:menus,nama,' . $menu->id,
            'deskripsi' => 'required|max:255',
            'jenis_makanan' => 'required',
            'harga' => 'required|numeric|min:1000',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'nama.unique' => 'Nama sudah ada dalam menu.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
            'jenis_makanan.required' => 'Jenis makanan harus dipilih.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga minimal adalah 1000.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto harus bertipe jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto && Storage::exists('public/' . $menu->foto)) {
                Storage::delete('public/' . $menu->foto);
            }
            $foto = $request->file('foto')->store('menu-images', 'public');
            $menu->foto = $foto;
        }

        $menu->nama = $request->input('nama');
        $menu->deskripsi = $request->input('deskripsi');
        $menu->jenis_makanan_id = $request->input('jenis_makanan');
        $menu->harga = $request->input('harga');
        $menu->save();

        return redirect()->route('menu')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->foto && Storage::exists('public/' . $menu->foto)) {
            Storage::delete('public/' . $menu->foto);
        }

        $menu->delete();

        return redirect()->route('menu')->with('success', 'Menu berhasil dihapus.');
    }
}
