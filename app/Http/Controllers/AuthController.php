<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterFormMerchant()
    {
        return view('auth.register-merchant');
    }

    public function showRegisterFormCustomer()
    {
        return view('auth.register-customer');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role->nama_role == 'Merchant') {
                return redirect()->intended('/menu');
            } else if (Auth::user()->role->nama_role == 'Customer') {
                return redirect()->intended('/order');
            }
        }

        return back()->withErrors(['credentials' => 'Email atau password salah.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'required|string|max:15',
            'role' => 'required|in:Customer,Merchant',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'kontak.required' => 'Kontak harus diisi.',
            'kontak.max' => 'Kontak maksimal 15 karakter.',
            'role.required' => 'Role harus dipilih.',
            'role.in' => 'Role harus berupa Pelanggan atau Merchant.',
        ]);        

        $role = Role::where('nama_role', $request->role)->first();

        $user = User::create([
            'role_id' => $role->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat ?? null,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}