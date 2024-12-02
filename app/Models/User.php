<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'tgl_join',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_user');
    }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class, 'id_user');
    // }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_user');
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'id_user');
    }
}
