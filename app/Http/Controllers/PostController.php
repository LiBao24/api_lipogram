<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Menambah post baru
     */
    public function tambahPost(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'media' => 'required|string',
            'caption' => 'required|string',
            'wkt_post' => 'required|date',
        ]);

        // Simpan post baru
        $post = Post::tambahPost($request->all());

        return response()->json(['message' => 'Post berhasil ditambahkan!', 'data' => $post], 201);
    }

    /**
     * Memberikan like pada post
     */
    public function likePost($id)
    {
        $post = Post::findOrFail($id);
        $post->like();

        return response()->json(['message' => 'Like berhasil ditambahkan!', 'data' => $post]);
    }

    /**
     * Memberikan komentar pada post
     */
    public function komentarPost($id)
    {
        $post = Post::findOrFail($id);
        $post->komentar();

        return response()->json(['message' => 'Komentar berhasil ditambahkan!', 'data' => $post]);
    }

    /**
     * Menghapus post
     */
    public function hapusPost($id)
    {
        $post = Post::findOrFail($id);
        $post->hapusPost();

        return response()->json(['message' => 'Post berhasil dihapus!']);
    }

    /**
     * Melihat komentar pada post
     */
    public function lihatKomentar($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->lihatKomentar();

        return response()->json($comments);
    }

    /**
     * Melihat jumlah like pada post
     */
    public function lihatLike($id)
    {
        $post = Post::findOrFail($id);
        return response()->json(['likes' => $post->lihatLike()]);
    }
}
