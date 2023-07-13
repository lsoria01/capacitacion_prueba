<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCalificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->boolean('curso_fin')->nullable();
            $table->boolean('aprobado')->nullable();
            $table->string('calif')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('anio')->nullable();
            $table->string('rechazo')->nullable();
            $table->string('url_constancia')->nullable();
            $table->string('nombre_constancia')->nullable();
            $table->unsignedBigInteger('estatus_id')->nullable();
            $table->foreign('estatus_id')->references('id')->on('estatus');
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
        Schema::dropIfExists('calificaciones');
    }
}
