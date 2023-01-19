<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('promo_id')->nullable()->default(null); 
            $table->foreign('promo_id')->references('id')->on('promo')->onDelete('set null');
            $table->unsignedBigInteger('mobil_id')->nullable()->default(null); 
            $table->foreign('mobil_id')->references('id')->on('mobil')->onDelete('set null');
            $table->unsignedBigInteger('dari_kota_id')->nullable()->default(null); 
            $table->foreign('dari_kota_id')->references('id')->on('kota')->onDelete('set null');
            $table->integer('harga')->nullable()->default(null);
            $table->string('gambar')->nullable()->default(null);
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
        Schema::dropIfExists('jurusan');
    }
}
