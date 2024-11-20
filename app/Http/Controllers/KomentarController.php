<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    /**
     * Menambah komentar baru pada post
     */
    public function tambahKomentar(Request $request, $postId)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'isi_komentar' => 'required|string',
            'wkt_komentar' => 'required|date',
        ]);

        // Simpan komentar baru pada post yang dituju
        $komentar = Komentar::create([
            'id_post' => $postId,
            'id_user' => $request->id_user,
            'isi_komentar' => $request->isi_komentar,
            'wkt_komentar' => $request->wkt_komentar,
        ]);

        return response()->json(['message' => 'Komentar berhasil ditambahkan!', 'data' => $komentar], 201);
    }

    /**
     * Membalas komentar tertentu
     */
    public function balasKomentar(Request $request, $idKomentar)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'isi_komentar' => 'required|string',
            'wkt_komentar' => 'required|date',
        ]);

        // Ambil komentar yang akan dibalas
        $komentar = Komentar::findOrFail($idKomentar);

        // Simpan balasan komentar
        $balasan = $komentar->balas([
            'id_post' => $komentar->id_post, // Gunakan id_post yang sama
            'id_user' => $request->id_user,
            'isi_komentar' => $request->isi_komentar,
            'wkt_komentar' => $request->wkt_komentar,
        ]);

        return response()->json(['message' => 'Balasan berhasil ditambahkan!', 'data' => $balasan]);
    }

    /**
     * Menghapus komentar
     */
    public function hapusKomentar($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus!']);
    }

    /**
     * Melihat semua komentar pada post tertentu
     */
    public function lihatKomentar($postId)
    {
        $komentars = Komentar::where('id_post', $postId)->get();

        return response()->json($komentars);
    }
}
