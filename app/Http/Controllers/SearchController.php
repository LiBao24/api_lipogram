<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;

class SearchController extends Controller
{
    /**
     * Menyimpan pencarian baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        // Simpan pencarian baru ke database
        $search = Search::create([
            'id_search' => uniqid(), // Menggunakan uniqid() sebagai id_search
            'search' => $request->input('search'),
        ]);

        // Kembalikan respon sukses
        return response()->json(['message' => 'Pencarian berhasil disimpan.', 'data' => $search], 201);
    }

    /**
     * Menampilkan hasil pencarian berdasarkan kata kunci.
     */
    public function cari(Request $request)
    {
        // Ambil kata kunci dari input
        $keyword = $request->input('q');

        // Cari hasil pencarian menggunakan model
        $results = Search::cari($keyword);

        // Kembalikan hasil pencarian dalam format JSON
        return response()->json($results);
    }

    /**
     * Menampilkan riwayat pencarian.
     */
    public function riwayat()
    {
        // Ambil riwayat pencarian terbaru
        $history = Search::riwayat();

        // Kembalikan riwayat dalam format JSON
        return response()->json($history);
    }
}
