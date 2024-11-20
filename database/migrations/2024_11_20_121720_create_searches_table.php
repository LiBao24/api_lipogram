<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchesTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel pencarian.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {
            // Menggunakan id_search sebagai primary key
            $table->string('id_search')->primary();
            $table->string('search'); // Kolom untuk menyimpan kata kunci pencarian
            $table->timestamps();      // Kolom created_at dan updated_at
        });
    }

    /**
     * Menghapus tabel pencarian.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('searches');
    }
}
