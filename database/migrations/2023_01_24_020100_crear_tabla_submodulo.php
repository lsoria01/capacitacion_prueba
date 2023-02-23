<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSubmodulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submodulo', function (Blueprint $table) {
            $table->id('id_submodulo');
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('id_modulo')->nullable();
            $table->foreign('id_modulo')->references('id_modulo')->on('modulo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submodulo');
    }
}
