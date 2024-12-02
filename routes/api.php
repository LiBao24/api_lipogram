<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;

Route::post('/daftar', [UserController::class, 'daftar']);
Route::post('/login', [UserController::class, 'login']);

Route::prefix('api/users')->group(function () {
    Route::post('/daftar', [UserController::class, 'daftar'])->name('users.daftar');
    Route::post('/login', [UserController::class, 'login'])->name('users.login');
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum')->name('users.logout');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [UserController::class, 'profil'])->name('users.profile');
        Route::patch('/profile/username', [UserController::class, 'setUsername'])->name('users.updateUsername');
        Route::patch('/profile/password', [UserController::class, 'setPassword'])->name('users.updatePassword');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profils/{id}', [ProfilController::class, 'show']);
    Route::put('/profils/{id}', [ProfilController::class, 'update']);
    Route::get('/profils/{id}/stats', [ProfilController::class, 'stats']);
});

Route::prefix('api/searches')->group(function () {
    Route::post('/', [SearchController::class, 'store'])->name('searches.store');
    Route::get('/', [SearchController::class, 'cari'])->name('searches.search');
    Route::get('/history/{id_user}', [SearchController::class, 'riwayat'])->name('searches.history');
});

Route::prefix('api/posts')->group(function () {
    Route::post('/', [PostController::class, 'tambahPost'])->name('posts.tambah');
    Route::post('/{id}/like', [PostController::class, 'likePost'])->name('posts.like');
    Route::get('/{id}/like', [PostController::class, 'lihatLike'])->name('posts.lihatLike');
    Route::post('{postId}/komentar', [KomentarController::class, 'tambahKomentar'])->name('komentars.tambah');
    Route::get('{postId}/komentar', [KomentarController::class, 'lihatKomentar'])->name('komentars.lihat');
    Route::delete('/{id}', [PostController::class, 'hapusPost'])->name('posts.hapus');
});

Route::prefix('api/komentar')->group(function () {
    Route::post('{idKomentar}/balas', [KomentarController::class, 'balasKomentar'])->name('komentars.balas');
    Route::delete('{id}', [KomentarController::class, 'hapusKomentar'])->name('komentars.hapus');
});

Route::post('/api/notifikasi', [NotifikasiController::class, 'tambahNotifikasi'])->name('notifikasis.tambah');
Route::get('/api/notifikasi/{userId}', [NotifikasiController::class, 'lihatNotifikasi'])->name('notifikasis.lihat');
