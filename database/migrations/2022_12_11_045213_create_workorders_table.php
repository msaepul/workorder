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
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->string('no_wo',18)->unique();
            $table->timestamp('wo_create');
            $table->string('kategori_wo');
            $table->string('jenis_perangkat')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('obyek')->nullable();
            $table->string('keadaan')->nullable();
            $table->string('lampiran')->nullable();
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
        Schema::dropIfExists('workorders');
    }
};
