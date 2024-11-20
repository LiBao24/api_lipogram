<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'komentars';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'id_post', 'id_user', 'isi_komentar', 'wkt_komentar',
    ];

    // Tentukan primary key
    protected $primaryKey = 'id_komentar';

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
     * Membalas komentar (misalnya, dengan membuat komentar baru terkait)
     */
    public function balas($commentData)
    {
        // Membuat balasan komentar
        return self::create($commentData);
    }
}
