<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8',
        ]);

        $request['tgl_join'] = now();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tgl_join' => $request->tgl_join,
        ]);

        return response()->json(['message' => 'Pendaftaran berhasil', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|username',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['message' => 'Login berhasil', 'token' => $token, 'user' => $user], 200);
        }

        throw ValidationException::withMessages(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil'], 200);
    }

    public function profil(Request $request)
    {
        return response()->json($request->user(), 200);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'username' => 'sometimes|string|max:30|unique:users,username,' . $user->id_user,
            'email' => 'sometimes|email|unique:users,email,' . $user->id_user,
            'password' => 'sometimes|string|min:8',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json(['message' => 'Profil berhasil diperbarui', 'user' => $user], 200);
    }

    /**
     * Setter untuk username.
     *
     * @param int $id_user
     * @param string $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function setUsername($id_user, $username)
    {
        $user = User::find($id_user);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->username = $username;
        $user->save();

        return response()->json(['message' => 'Username berhasil diperbarui', 'username' => $user->username], 200);
    }

    /**
     * Getter untuk username.
     *
     * @param int $id_user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsername($id_user)
    {
        $user = User::find($id_user);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json(['username' => $user->username], 200);
    }

    /**
     * Setter untuk password.
     *
     * @param int $id_user
     * @param string $password
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPassword($id_user, $password)
    {
        $user = User::find($id_user);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        return response()->json(['message' => 'Password berhasil diperbarui'], 200);
    }
}
