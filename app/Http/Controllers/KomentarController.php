<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function tambahKomentar(Request $request, $postId)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'isi_komentar' => 'required|string',
            'wkt_komentar' => 'required|date',
        ]);

        $komentar = Komentar::create([
            'id_post' => $postId,
            'id_user' => $request->id_user,
            'isi_komentar' => $request->isi_komentar,
            'wkt_komentar' => $request->wkt_komentar,
        ]);

        return response()->json(['message' => 'Komentar berhasil ditambahkan!', 'data' => $komentar], 201);
    }

    public function balasKomentar(Request $request, $idKomentar)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'isi_komentar' => 'required|string',
            'wkt_komentar' => 'required|date',
        ]);

        $komentar = Komentar::findOrFail($idKomentar);

        $balasan = $komentar->balas([
            'id_post' => $komentar->id_post,
            'id_user' => $request->id_user,
            'isi_komentar' => $request->isi_komentar,
            'wkt_komentar' => $request->wkt_komentar,
        ]);

        return response()->json(['message' => 'Balasan berhasil ditambahkan!', 'data' => $balasan]);
    }

    public function hapusKomentar($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus!']);
    }

    public function lihatKomentar($postId)
    {
        $komentars = Komentar::where('id_post', $postId)->get();

        return response()->json($komentars);
    }
}
