<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user'); // Primary key
            $table->string('username', 255)->unique(); // Kolom username
            $table->string('email')->unique(); // Kolom email
            $table->string('password'); // Kolom password (hashed)
            $table->timestamp('tgl_join')->nullable(); // Kolom tanggal join
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
