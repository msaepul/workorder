<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris',18)->unique();
            $table->string('jenis_perangkat')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->double('harga')->nullable();
            $table->string('status')->nullable();
            $table->string('user_id')->nullable();
            $table->string('cabang_id')->nullable();
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
        Schema::dropIfExists('perangkat');
    }
};
