<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tampilkan data profil pengguna.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $profil = Profil::where('id_user', $id)->first();

        if ($profil) {
            return response()->json($profil, 200);
        }

        return response()->json(['message' => 'Profil tidak ditemukan'], 404);
    }

    /**
     * Edit profil pengguna.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $profil = Profil::where('id_user', $id)->first();

        if ($profil) {
            $data = $request->validate([
                'nama' => 'string|max:255',
                'bio' => 'string|max:255|nullable',
                'foto_profil' => 'nullable|image|max:2048', // Validasi untuk upload file
            ]);

            if ($request->hasFile('foto_profil')) {
                $data['foto_profil'] = file_get_contents($request->file('foto_profil'));
            }

            $profil->editProfil($data);

            return response()->json(['message' => 'Profil berhasil diperbarui', 'profile' => $profil], 200);
        }

        return response()->json(['message' => 'Profil tidak ditemukan'], 404);
    }

    /**
     * Hitung jumlah pengikut, mengikuti, dan post pengguna.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats($id)
    {
        $profil = Profil::where('id_user', $id)->first();

        if ($profil) {
            return response()->json([
                'pengikut' => $profil->hitungPengikut(),
                'mengikuti' => $profil->hitungMengikuti(),
                'post' => $profil->hitungPost(),
            ], 200);
        }

        return response()->json(['message' => 'Profil tidak ditemukan'], 404);
    }
}
