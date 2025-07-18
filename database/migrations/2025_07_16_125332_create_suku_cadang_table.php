<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSukuCadangTable extends Migration
{
    public function up()
    {
        Schema::create('suku_cadang', function (Blueprint $table) {
            $table->id('suku_cadang_id');
            $table->string('nama_barang', 100);
            $table->string('satuan', 20);
            $table->decimal('harga', 10, 2);
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suku_cadang');
    }
}
