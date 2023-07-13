<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('num_empleado')->nullable();
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->date('fecha_ingr')->nullable();
            $table->unsignedBigInteger('nivel_id')->nullable();
            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->unsignedBigInteger('puesto_id')->nullable();
            $table->foreign('puesto_id')->references('id')->on('puestos');
            $table->unsignedBigInteger('adscripcion_id')->nullable();
            $table->foreign('adscripcion_id')->references('id')->on('adscripciones');
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('ciudad_adscripcion')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable()->comment('El campo empleado_id hace referencia al superior jerárquico');           
            $table->timestamps();
            $table->softDeletes();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
