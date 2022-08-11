<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->string('nombre')->nullable();
            $table->unsignedBigInteger('puesto')->nullable();
            $table->unsignedBigInteger('adscripcion')->nullable();
            $table->string('correo')->nullable();
            $table->string('curp')->nullable();
            $table->string('password')->nullable();
            $table->boolean('estatus')->nullable();
            $table->integer('rol')->nullable();
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
        Schema::dropIfExists('empleado');
    }
}
