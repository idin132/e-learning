<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'teacher') {
                return redirect()->route('dashboard.index');
            } elseif ($user->role === 'student') {
                return redirect()->route('dashboard.index');
            }

            // fallback jika role tidak dikenali
            return redirect('/login');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // butuh input password_confirmation di view
        ]);

        // 1. Buat User di tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Default register sebagai siswa
        ]);

        // 2. Buat data dummy di tabel students (relasi)
        // Pastikan model Student sudah dibuat dan fillable
        // Jika belum ada model Student, hapus bagian ini seme  ntara
         students::create([
            'user_id' => $user->id,
            'class_id' => 1, // Default sementara (bisa diubah logicnya)
            'nis' => rand(1000, 9999),
        ]); 

        // 3. Auto login setelah register
        Auth::login($user);

        return redirect('/');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}