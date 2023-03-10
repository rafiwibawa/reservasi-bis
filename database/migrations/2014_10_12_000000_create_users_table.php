<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_id')->nullable()->default(null);
            $table->string('google_id')->nullable()->default(null);
            $table->string('nama');
            $table->string('email')->unique();
            $table->integer('umur')->nullable()->default(null); 
            $table->string('nomor_ponsel')->nullable()->default(null); 
            $table->enum('hak_akses',['admin','kasir']); 
            $table->string('password')->nullable(); 
            $table->timestamps();
            $table->softDeletes(); 
            $table->string('kunci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
