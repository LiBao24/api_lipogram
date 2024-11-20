<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menampilkan hasil pencarian berdasarkan kata kunci
Route::get('/api/search', [SearchController::class, 'cari'])->name('search.cari');

// Rute untuk menampilkan riwayat pencarian terbaru
Route::get('/api/riwayat', [SearchController::class, 'riwayat'])->name('search.riwayat');

// Rute untuk menyimpan pencarian baru
Route::post('/api/search', [SearchController::class, 'store'])->name('search.store');

// Rute untuk menambah post
Route::post('/api/posts', [PostController::class, 'tambahPost'])->name('posts.tambah');

// Rute untuk memberikan like pada post
Route::post('/api/posts/{id}/like', [PostController::class, 'likePost'])->name('posts.like');

// Rute untuk memberikan komentar pada post
Route::post('/api/posts/{id}/komentar', [PostController::class, 'komentarPost'])->name('posts.komentar');

// Rute untuk menghapus post
Route::delete('/api/posts/{id}', [PostController::class, 'hapusPost'])->name('posts.hapus');

// Rute untuk melihat komentar pada post
Route::get('/api/posts/{id}/komentar', [PostController::class, 'lihatKomentar'])->name('posts.lihatKomentar');

// Rute untuk melihat jumlah like pada post
Route::get('/api/posts/{id}/like', [PostController::class, 'lihatLike'])->name('posts.lihatLike');

// Rute untuk menambah komentar pada post
Route::post('/api/posts/{postId}/komentar', [KomentarController::class, 'tambahKomentar'])->name('komentars.tambah');

// Rute untuk membalas komentar
Route::post('/api/komentar/{idKomentar}/balas', [KomentarController::class, 'balasKomentar'])->name('komentars.balas');

// Rute untuk menghapus komentar
Route::delete('/api/komentar/{id}', [KomentarController::class, 'hapusKomentar'])->name('komentars.hapus');

// Rute untuk melihat komentar pada post
Route::get('/api/posts/{postId}/komentar', [KomentarController::class, 'lihatKomentar'])->name('komentars.lihat');

// Rute untuk menambah notifikasi
Route::post('/api/notifikasi', [NotifikasiController::class, 'tambahNotifikasi'])->name('notifikasis.tambah');

// Rute untuk melihat notifikasi berdasarkan user
Route::get('/api/notifikasi/{userId}', [NotifikasiController::class, 'lihatNotifikasi'])->name('notifikasis.lihat');

// Rute untuk menghapus notifikasi
Route::delete('/api/notifikasi/{id}', [NotifikasiController::class, 'hapusNotifikasi'])->name('notifikasis.hapus');
