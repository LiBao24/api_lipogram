<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentars';

    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_post',
        'id_user',
        'isi_komentar',
        'wkt_komentar',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
