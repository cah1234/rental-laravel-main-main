<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('kendaraan_id');
            $table->foreignId('pelanggan_id')->constrained('pelanggan', 'pelanggan_id')->onDelete('cascade');
            $table->string('no_polisi', 20)->unique();
            $table->string('merk', 50);
            $table->string('tipe', 50);
            $table->integer('tahun');
            $table->string('warna', 30);
            $table->string('no_rangka', 50);
            $table->string('no_mesin', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
}
