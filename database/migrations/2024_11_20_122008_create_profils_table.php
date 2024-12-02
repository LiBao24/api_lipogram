<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->increments('id_profil');
            $table->Integer('id_user');
            $table->string('nama', 255);
            $table->string('bio', 255)->nullable();
            $table->binary('foto_profil')->nullable(); // Menyimpan gambar sebagai binary data
            $table->integer('jmlh_pengikut')->default(0);
            $table->integer('jmlh_mengikuti')->default(0);
            $table->integer('jmlh_post')->default(0);

            // $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('profils');
    }
};
