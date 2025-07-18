<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamDetailPartTable extends Migration
{
    public function up()
    {
        Schema::create('rekam_detail_part', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_id')->constrained('rekam_medis', 'rekam_id')->onDelete('cascade');
            $table->foreignId('suku_cadang_id')->constrained('suku_cadang', 'suku_cadang_id')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekam_detail_part');
    }
}
