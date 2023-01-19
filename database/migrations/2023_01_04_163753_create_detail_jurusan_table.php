<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jurusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurusan_id')->nullable()->default(null); 
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('set null');
            $table->unsignedBigInteger('ke_kota_id')->nullable()->default(null); 
            $table->foreign('ke_kota_id')->references('id')->on('kota')->onDelete('set null');
            $table->string('urutan')->nullable()->default(null);
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
        Schema::dropIfExists('detail_jurusan');
    }
}
