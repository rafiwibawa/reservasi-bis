<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservasi_id')->nullable()->default(null); 
            $table->foreign('reservasi_id')->references('id')->on('reservasi')->onDelete('set null');
            $table->unsignedBigInteger('jurusan_id')->nullable()->default(null); 
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('set null');
            $table->integer('nik')->nullable()->default(null); 
            $table->string('name')->nullable()->default(null); 
            $table->integer('harga')->nullable()->default(null); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_reservasi');
    }
}
