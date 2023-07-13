<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarioPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aplicaciones_id')->nullable();
            $table->foreign('aplicaciones_id')->references('id')->on('aplicaciones');
            $table->unsignedBigInteger('modulos_id')->nullable();
            $table->foreign('modulos_id')->references('id')->on('modulos');
            $table->unsignedBigInteger('submodulos_id')->nullable();
            $table->foreign('submodulos_id')->references('id')->on('submodulos');
            $table->unsignedBigInteger('permisos_id')->nullable();
            $table->foreign('permisos_id')->references('id')->on('permisos');
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_permisos');
    }
}
