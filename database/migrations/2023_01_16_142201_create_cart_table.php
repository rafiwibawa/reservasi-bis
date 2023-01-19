<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jurusan_id')->nullable()->default(null); 
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('set null');
            $table->string('nama')->nullable()->default(null); 
            $table->string('nik')->nullable()->default(null); 
            $table->unsignedBigInteger('user_id')->nullable()->default(null); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('cart');
    }
}
