<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba otentikasi user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Periksa apakah user memiliki peran admin
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            // Jika bukan admin, logout dan kembalikan pesan error
            Auth::logout();
            return back()->withErrors([
                'email' => 'Access denied for this account',
            ])->withInput();
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->withInput();
    }

    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan data user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Assign role admin
        $user->assignRole('admin');

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Registration successful! Welcome!');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/admin')->with('success', 'You have been logged out.');
    }
}
