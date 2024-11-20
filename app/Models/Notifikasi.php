<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'notifikasis';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'id_post', 'id_user', 'isi_notifikasi', 'wkt_notifikasi',
    ];

    // Tentukan primary key
    protected $primaryKey = 'id_notifikasi';

    // Relasi dengan Post (satu ke banyak)
    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    // Relasi dengan User (satu ke banyak)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Menampilkan notifikasi berdasarkan user
     */
    public function lihatNotifikasi($userId)
    {
        // Mengambil notifikasi yang terkait dengan user
        return self::where('id_user', $userId)->get();
    }
}
