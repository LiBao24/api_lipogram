<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Melihat notifikasi berdasarkan user
     */
    public function lihatNotifikasi($userId)
    {
        // Mendapatkan notifikasi dari model berdasarkan user
        $notifikasis = Notifikasi::lihatNotifikasi($userId);

        // Mengembalikan data notifikasi sebagai response JSON
        return response()->json($notifikasis);
    }

    /**
     * Menambah notifikasi untuk user tertentu
     */
    public function tambahNotifikasi(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_post' => 'required|exists:posts,id_post',
            'id_user' => 'required|exists:users,id',
            'isi_notifikasi' => 'required|string',
            'wkt_notifikasi' => 'required|date',
        ]);

        // Menyimpan notifikasi baru
        $notifikasi = Notifikasi::create([
            'id_post' => $request->id_post,
            'id_user' => $request->id_user,
            'isi_notifikasi' => $request->isi_notifikasi,
            'wkt_notifikasi' => $request->wkt_notifikasi,
        ]);

        return response()->json(['message' => 'Notifikasi berhasil ditambahkan!', 'data' => $notifikasi], 201);
    }

    /**
     * Menghapus notifikasi
     */
    public function hapusNotifikasi($id)
    {
        // Temukan notifikasi berdasarkan id
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return response()->json(['message' => 'Notifikasi berhasil dihapus!']);
    }
}
