<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamMedisTable extends Migration
{
    public function up()
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id('rekam_id');
            $table->foreignId('kendaraan_id')->constrained('kendaraan', 'kendaraan_id')->onDelete('cascade');
            $table->unsignedBigInteger('teknisi_id');
            $table->date('tanggal_servis');
            $table->text('keluhan')->nullable();
            $table->text('tindakan_servis')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->enum('status_servis', ['Selesai', 'Dalam Proses', 'Dibatalkan'])->default('Dalam Proses');
            $table->timestamps();

            $table->foreign('teknisi_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekam_medis');
    }
}
