<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel posts.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id_post');
            $table->unsignedBigInteger('id_user');
            $table->longText('media');
            $table->text('caption');
            $table->integer('jmlh_like')->default(0);
            $table->integer('jmlh_komentar')->default(0);
            $table->date('wkt_post');
            $table->timestamps();

            // Menambahkan foreign key untuk id_user (relasi ke tabel users)
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Menghapus tabel posts.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
