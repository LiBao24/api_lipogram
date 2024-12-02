<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id_post';

    protected $fillable = [
        'id_user',
        'media',
        'caption',
        'jmlh_like',
        'jmlh_komentar',
        'wkt_post',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class, 'id_post');
    }
}
