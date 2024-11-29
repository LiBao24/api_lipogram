<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->increments('id_notifikasi');
            $table->unsignedBigInteger('id_post')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->string('isi_notifikasi');
            $table->dateTime('wkt_notifikasi');
            $table->timestamps();

            $table->foreign('id_post')->references('id_post')->on('posts')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
}
