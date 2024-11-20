<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel komentars.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->unsignedBigInteger('id_post');
            $table->unsignedBigInteger('id_user');
            $table->text('isi_komentar');
            $table->date('wkt_komentar');
            $table->timestamps();

            // Menambahkan foreign key untuk id_post dan id_user
            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Menghapus tabel komentars.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komentars');
    }
}
