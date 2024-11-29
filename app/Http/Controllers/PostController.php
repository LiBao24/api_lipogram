<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menambah post baru
    public function tambahPost(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'media' => 'required|string',
            'caption' => 'required|string',
            'wkt_post' => 'required|date',
        ]);

        $post = Post::create($request->all());

        return response()->json(['message' => 'Post berhasil ditambahkan!', 'data' => $post], 201);
    }

    // Memberikan like pada post
    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('jmlh_like');

        return response()->json(['message' => 'Like berhasil ditambahkan!', 'data' => $post], 200);
    }

    // Memberikan komentar pada post
    public function komentarPost($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('jmlh_komentar');

        return response()->json(['message' => 'Komentar berhasil ditambahkan!', 'data' => $post], 200);
    }

    // Menghapus post
    public function hapusPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post berhasil dihapus!'], 200);
    }

    // Melihat komentar pada post
    public function lihatKomentar($id)
    {
        $post = Post::with('komentar')->findOrFail($id);

        return response()->json(['message' => 'Komentar pada post ditemukan!', 'data' => $post->komentar], 200);
    }

    // Melihat jumlah like pada post
    public function lihatLike($id)
    {
        $post = Post::findOrFail($id);

        return response()->json(['likes' => $post->jmlh_like], 200);
    }
}
