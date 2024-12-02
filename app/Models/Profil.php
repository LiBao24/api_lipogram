<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profils';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'id_user',
        'nama',
        'bio',
        'foto_profil',
        'jmlh_pengikut',
        'jmlh_mengikuti',
        'jmlh_post',
    ];

    public $timestamps = false;

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
