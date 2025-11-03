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
        $remember = $request->has('remember'); // Cek checkbox "Ingat saya"

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // --- DASHBOARD (Fungsi ini tidak terpakai jika web.php ke PostController) ---
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $user = Auth::user();
        // $posts = \App\Models\Post::where('user_id', $user->id)->get(); // Contoh jika pakai Model
        // return view('dashboard', compact('user', 'posts'));
        return "Fungsi dashboard di AuthController. Harusnya ke PostController.";
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout(); // Ini akan menghapus session & cookie remember me
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
