<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarioPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarioPermiso', function (Blueprint $table) {
            $table->id('id_usuarioPermiso');
            $table->unsignedBigInteger('id_aplicacion')->nullable();
            $table->foreign('id_aplicacion')->references('id_aplicacion')->on('aplicacion');
            $table->unsignedBigInteger('id_modulo')->nullable();
            $table->foreign('id_modulo')->references('id_modulo')->on('modulo');
            $table->unsignedBigInteger('id_submodulo')->nullable();
            $table->foreign('id_submodulo')->references('id_submodulo')->on('submodulo');
            $table->unsignedBigInteger('id_permiso')->nullable();
            $table->foreign('id_permiso')->references('id_permiso')->on('permiso');
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarioPermiso');
    }
}
