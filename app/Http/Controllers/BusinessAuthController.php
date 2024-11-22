<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('business.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->hasRole('business')) {
                return redirect()->route('business.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function showRegisterForm()
    {
        return view('business.register');
    }

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

        // Assign role business
        $user->assignRole('business');

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard business
        return redirect()->route('business.dashboard')->with('success', 'Registration successful! Welcome!');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout user
        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('business/login')->with('success', 'You have been logged out.');
    }
}
