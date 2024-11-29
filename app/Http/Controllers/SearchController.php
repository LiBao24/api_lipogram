<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;

class SearchController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'search' => 'required|string|max:255',
        ]);

        $search = Search::create([
            'id_user' => $request->input('id_user'),
            'search' => $request->input('search'),
        ]);

        return response()->json(['message' => 'Pencarian berhasil disimpan.', 'data' => $search], 201);
    }

    public function cari(Request $request)
    {
        $keyword = $request->input('q');

        $results = Search::where('search', 'like', "%{$keyword}%")->get();

        return response()->json($results);
    }

    public function riwayat($id_user)
    {
        $history = Search::where('id_user', $id_user) // Filter berdasarkan user
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json($history);
    }
}
