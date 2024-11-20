<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    // ====== Konfigurasi Model ======

    protected $table = 'profils'; // Nama tabel
    protected $primaryKey = 'id_profil'; // Primary key

    protected $fillable = [
        'id_user',
        'nama',
        'bio',
        'foto_profil',
        'jmlh_pengikut',
        'jmlh_mengikuti',
        'jmlh_post',
    ];

    public $timestamps = false; // Nonaktifkan timestamps default Laravel

    // ====== Relasi ======

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // ====== Method ======

    /**
     * Tambahkan pengikut baru.
     */
    public function ikuti()
    {
        $this->jmlh_pengikut++;
        $this->save();
    }

    /**
     * Edit data profil.
     *
     * @param array $data
     * @return bool
     */
    public function editProfil(array $data)
    {
        $this->fill($data);
        return $this->save();
    }

    /**
     * Hitung jumlah pengikut.
     *
     * @return int
     */
    public function hitungPengikut()
    {
        return $this->jmlh_pengikut;
    }

    /**
     * Hitung jumlah akun yang diikuti.
     *
     * @return int
     */
    public function hitungMengikuti()
    {
        return $this->jmlh_mengikuti;
    }

    /**
     * Hitung jumlah post.
     *
     * @return int
     */
    public function hitungPost()
    {
        return $this->jmlh_post;
    }
}
