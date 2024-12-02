<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id_post');
            $table->Integer('id_user');
            $table->longText('media');
            $table->text('caption');
            $table->integer('jmlh_like')->default(0);
            $table->integer('jmlh_komentar')->default(0);
            $table->date('wkt_post');
            $table->timestamps();

            // $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
