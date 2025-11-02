<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- REGISTER ---
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    // --- LOGIN ---
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // cek checkbox

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // regenerasi session untuk keamanan
            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // --- DASHBOARD ---
    public function dashboard()
    {
        // Cek user yang sedang login pakai Auth, bukan Session
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data user aktif
        $user = Auth::user();

        // Kamu bisa ambil post milik user ini (contoh kalau pakai model Post)
        $posts = \App\Models\Post::where('user_id', $user->id)->get();

        return view('dashboard', compact('user', 'posts'));
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout(); // hapus cookie remember me juga
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}