<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSubmodulos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodulos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('modulo_id')->nullable();
            $table->foreign('modulo_id')->references('id')->on('modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submodulos');
    }
}
