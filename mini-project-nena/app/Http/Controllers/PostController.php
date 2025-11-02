<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Menampilkan dashboard (daftar postingan).
     */
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        $user = session('user');

        $posts = DB::table('posts')
            ->where('user_id', $user->id_user)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', ['posts' => $posts]);
    }

    /**
     * Menampilkan form untuk membuat postingan baru.
     */
    public function create()
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        return view('posts.create');
    }

    /**
     * Menyimpan postingan baru ke database.
     */
    public function store(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::table('posts')->insert([
            'user_id'    => $user->id_user,
            'title'      => $request->title,
            'body'       => $request->body,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'Postingan berhasil dibuat!');
    }

    // --- INI FUNGSI-FUNGSI BARU YANG HILANG ---

    /**
     * Menampilkan form untuk mengedit postingan.
     */
    public function edit($id)
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        $user = session('user');

        // Ambil data postingan yang mau diedit
        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek apakah postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek apakah postingan ini milik user yang login
        if ($post->user_id != $user->id_user) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin untuk mengedit postingan ini.');
        }

        // Jika aman, tampilkan view edit dengan data $post
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Mengupdate postingan di database.
     */
    public function update(Request $request, $id)
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        $user = session('user');

        // Validasi input baru
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        // Ambil postingan yang mau diupdate
        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek kepemilikan
        if ($post->user_id != $user->id_user) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin.');
        }

        // Update data di database
        DB::table('posts')->where('id_post', $id)->update([
            'title'      => $request->title,
            'body'       => $request->body,
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Menghapus postingan dari database.
     */
    public function destroy($id)
    {
        if (!session()->has('user')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        $user = session('user');

        // Ambil postingan
        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek kepemilikan
        if ($post->user_id != $user->id_user) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin.');
        }

        // Hapus data
        DB::table('posts')->where('id_post', $id)->delete();

        return redirect('/dashboard')->with('success', 'Postingan berhasil dihapus!');
    }
}

