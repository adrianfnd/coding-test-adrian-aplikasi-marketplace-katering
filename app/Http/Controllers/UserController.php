<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = Auth::user();
    
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
    
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
    
            $user->profile_image = $imagePath;
        }
    
        $user->update([
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'alamat' => $request->input('alamat'),
            'kontak' => $request->input('kontak'),
            'deskripsi' => $request->input('deskripsi'),
            'profile_image' => $user->profile_image,
        ]);
    
        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
    
}
