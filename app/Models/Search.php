<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model
    protected $table = 'searches';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'search',
    ];

    // Tentukan primary key
    protected $primaryKey = 'id_search';

    /**
     * Cari berdasarkan kata kunci.
     */
    public static function cari($keyword)
    {
        return self::where('search', 'like', "%{$keyword}%")->get();
    }

    /**
     * Menampilkan riwayat pencarian terbaru.
     */
    public static function riwayat()
    {
        return self::orderBy('created_at', 'desc')->limit(5)->get();
    }
}
