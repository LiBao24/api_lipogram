<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'posts';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'id_user', 'media', 'caption', 'jmlh_like', 'jmlh_komentar', 'wkt_post',
    ];

    // Tentukan primary key
    protected $primaryKey = 'id_post';

    // Relasi dengan User (satu ke banyak)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Menambah jumlah like pada post
     */
    public function like()
    {
        $this->increment('jmlh_like');
        $this->save();
    }

    /**
     * Menambah jumlah komentar pada post
     */
    public function komentar()
    {
        $this->increment('jmlh_komentar');
        $this->save();
    }

    /**
     * Menambahkan post baru
     */
    public static function tambahPost($data)
    {
        return self::create($data);
    }

    /**
     * Menghapus post
     */
    public function hapusPost()
    {
        $this->delete();
    }

    /**
     * Melihat komentar pada post
     */
    public function lihatKomentar()
    {
        // Asumsikan ada relasi komentar pada model ini, jika ada tabel komentar
        return $this->hasMany(Komentar::class, 'id_post');
    }

    /**
     * Melihat jumlah like pada post
     */
    public function lihatLike()
    {
        return $this->jmlh_like;
    }
}
