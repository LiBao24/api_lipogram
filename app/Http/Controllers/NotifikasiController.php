<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function lihatNotifikasi($userId)
    {
        $notifikasis = Notifikasi::where('id_user', $userId)->orderBy('wkt_notifikasi', 'desc')->get();

        return response()->json($notifikasis);
    }

    public function tambahNotifikasi(Request $request)
    {
        $request->validate([
            'id_post' => 'nullable|exists:posts,id_post',
            'id_user' => 'required|exists:users,id',
            'isi_notifikasi' => 'required|string',
            'wkt_notifikasi' => 'required|date',
        ]);

        $notifikasi = Notifikasi::create([
            'id_post' => $request->id_post,
            'id_user' => $request->id_user,
            'isi_notifikasi' => $request->isi_notifikasi,
            'wkt_notifikasi' => $request->wkt_notifikasi,
        ]);

        return response()->json(['message' => 'Notifikasi berhasil ditambahkan!', 'data' => $notifikasi], 201);
    }
}
