<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // <-- Gunakan Auth

class PostController extends Controller
{
    /**
     * Menampilkan dashboard dengan postingan milik user.
     * Middleware 'auth' sudah melindungi rute ini.
     */
    public function index()
    {
        // 'auth()->id()' akan mengambil ID user yang sedang login
        // (baik dari session atau cookie "remember me")
        $posts = DB::table('posts')
            ->where('user_id', auth()->id()) // Gunakan auth()->id()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', ['posts' => $posts]);
    }

    /**
     * Menampilkan form untuk membuat postingan baru.
     * Middleware 'auth' sudah melindungi rute ini.
     */
    public function create()
    {
        // Kita tidak perlu cek session lagi, middleware sudah melakukannya
        return view('posts.create');
    }

    /**
     * Menyimpan postingan baru.
     * Middleware 'auth' sudah melindungi rute ini.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        DB::table('posts')->insert([
            'user_id'    => auth()->id(), // Gunakan auth()->id()
            'title'      => $request->title,
            'body'       => $request->body,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'Postingan berhasil dibuat!');
    }

    /**
     * Menampilkan form untuk mengedit postingan.
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek kepemilikan
        if ($post->user_id != auth()->id()) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Mengupdate postingan di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek kepemilikan
        if ($post->user_id != auth()->id()) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin.');
        }

        // Update data
        DB::table('posts')->where('id_post', $id)->update([
            'title'      => $request->title,
            'body'       => $request->body,
            'updated_at' => now()
        ]);

        return redirect('/dashboard')->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Menghapus postingan.
     */
    public function destroy($id)
    {
        $post = DB::table('posts')->where('id_post', $id)->first();

        // Keamanan: Cek postingan ada
        if (!$post) {
            return redirect('/dashboard')->with('error', 'Postingan tidak ditemukan.');
        }

        // Keamanan: Cek kepemilikan
        if ($post->user_id != auth()->id()) {
            return redirect('/dashboard')->with('error', 'Anda tidak punya izin.');
        }

        // Hapus data
        DB::table('posts')->where('id_post', $id)->delete();

        return redirect('/dashboard')->with('success', 'Postingan berhasil dihapus!');
    }
}