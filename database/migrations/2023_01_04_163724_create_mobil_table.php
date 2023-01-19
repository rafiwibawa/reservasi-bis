<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supir_id')->nullable()->default(null); 
            $table->foreign('supir_id')->references('id')->on('supir')->onDelete('set null');
            $table->unsignedBigInteger('merek_mobil_id')->nullable()->default(null); 
            $table->foreign('merek_mobil_id')->references('id')->on('merek_mobil')->onDelete('set null');
            $table->string('cc')->nullable()->default(null);
            $table->integer('jumlah_kapasitas')->nullable()->default(null);
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
        Schema::dropIfExists('mobil');
    }
}
