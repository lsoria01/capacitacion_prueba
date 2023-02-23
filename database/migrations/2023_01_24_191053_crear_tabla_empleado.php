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
            $table->unsignedBigInteger('id_persona')->nullable();
            $table->foreign('id_persona')->references('id_persona')->on('persona');
            $table->date('fechaIngr')->nullable();
            $table->string('nivel')->nullable();
            $table->string('puesto')->nullable();
            $table->string('adscripcion')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudadAdscr')->nullable();            
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
