<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Tambahkan pengikut baru.
     *
     * @param int $id_profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function ikuti($id_profil)
    {
        $profil = Profil::find($id_profil);

        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        $profil->jmlh_pengikut++;
        $profil->save();

        return response()->json(['message' => 'Pengikut berhasil ditambahkan', 'jmlh_pengikut' => $profil->jmlh_pengikut], 200);
    }

    /**
     * Edit data profil.
     *
     * @param Request $request
     * @param int $id_profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfil(Request $request, $id_profil)
    {
        $profil = Profil::find($id_profil);

        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string|max:255',
            'foto_profil' => 'sometimes|image|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profil_pictures', 'public');
            $data['foto_profil'] = $path;
        }

        $profil->update($data);

        return response()->json(['message' => 'Profil berhasil diperbarui', 'profil' => $profil], 200);
    }

    /**
     * Hitung jumlah pengikut.
     *
     * @param int $id_profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function hitungPengikut($id_profil)
    {
        $profil = Profil::find($id_profil);

        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        return response()->json(['jmlh_pengikut' => $profil->jmlh_pengikut], 200);
    }

    /**
     * Hitung jumlah akun yang diikuti.
     *
     * @param int $id_profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function hitungMengikuti($id_profil)
    {
        $profil = Profil::find($id_profil);

        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        return response()->json(['jmlh_mengikuti' => $profil->jmlh_mengikuti], 200);
    }

    /**
     * Hitung jumlah post.
     *
     * @param int $id_profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function hitungPost($id_profil)
    {
        $profil = Profil::find($id_profil);

        if (!$profil) {
            return response()->json(['message' => 'Profil tidak ditemukan'], 404);
        }

        return response()->json(['jmlh_post' => $profil->jmlh_post], 200);
    }

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

    

    // /**
    //  * Edit profil pengguna.
    //  *
    //  * @param Request $request
    //  * @param int $id
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function update(Request $request, $id)
    // {
    //     $profil = Profil::where('id_user', $id)->first();

    //     if ($profil) {
    //         $data = $request->validate([
    //             'nama' => 'string|max:255',
    //             'bio' => 'string|max:255|nullable',
    //             'foto_profil' => 'nullable|image|max:2048', // Validasi untuk upload file
    //         ]);

    //         if ($request->hasFile('foto_profil')) {
    //             $data['foto_profil'] = file_get_contents($request->file('foto_profil'));
    //         }

    //         $profil->editProfil($data);

    //         return response()->json(['message' => 'Profil berhasil diperbarui', 'profile' => $profil], 200);
    //     }

    //     return response()->json(['message' => 'Profil tidak ditemukan'], 404);
    // }

    /**
     * Hitung jumlah pengikut, mengikuti, dan post pengguna.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    // public function stats($id)
    // {
    //     $profil = Profil::where('id_user', $id)->first();

    //     if ($profil) {
    //         return response()->json([
    //             'pengikut' => $profil->hitungPengikut(),
    //             'mengikuti' => $profil->hitungMengikuti(),
    //             'post' => $profil->hitungPost(),
    //         ], 200);
    //     }

    //     return response()->json(['message' => 'Profil tidak ditemukan'], 404);
    // }
}
