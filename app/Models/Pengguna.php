<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Pengguna extends Model
{
    // ====== Konfigurasi Model ======

    // Nama tabel di database
    protected $table = 'users';

    // Primary key
    protected $primaryKey = 'id_user';

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'username',
        'email',
        'password',
        'tgl_join',
    ];

    // Atribut yang tidak boleh ditampilkan dalam array atau JSON
    protected $hidden = [
        'password',
    ];

    // Menonaktifkan timestamps default Laravel
    public $timestamps = false;

    // ====== Relasi ======

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_user');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_user');
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_user');
    }

    // ====== Validasi ======

    /**
     * Validasi input data untuk pendaftaran pengguna baru.
     *
     * @param array $data
     * @throws ValidationException
     */
    public static function validateRegistrationData(array $data)
    {
        $validator = Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    // ====== Fungsi CRUD dan Autentikasi ======

    /**
     * Login pengguna berdasarkan email dan password.
     *
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    public function login($email, $password)
    {
        $user = self::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            // Login berhasil, kembalikan user
            return $user;
        }
        return false; // Login gagal
    }

    /**
     * Logout pengguna.
     *
     * @return bool
     */
    public function logout()
    {
        $this->currentAccessToken()->delete();
        return true; // Logout berhasil
    }

    /**
     * Daftar pengguna baru.
     *
     * @param array $data
     * @return User
     */
    public static function daftar(array $data)
    {
        // Validasi data
        self::validateRegistrationData($data);

        // Enkripsi password
        $data['password'] = Hash::make($data['password']);
        $data['tgl_join'] = now(); // Tambahkan waktu pendaftaran

        // Buat pengguna baru
        return self::create($data);
    }

    // ====== Getter dan Setter ======

    /**
     * Setter untuk username.
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        $this->save();
    }

    /**
     * Getter untuk username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Setter untuk password.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Hash::make($password);
        $this->save();
    }

    /**
     * Getter untuk password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password; // Biasanya disembunyikan untuk alasan keamanan
    }

    // ====== Fungsi Tambahan ======

    /**
     * Perbarui profil pengguna.
     *
     * @param array $data
     * @return bool
     */
    public function updateProfile(array $data)
    {
        $this->fill($data);
        return $this->save();
    }

    /**
     * Verifikasi email pengguna.
     *
     * @param string $email
     * @return bool
     */
    public static function isEmailVerified($email)
    {
        return self::where('email', $email)->exists();
    }
}
