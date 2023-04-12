<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCalificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacion', function (Blueprint $table) {
            $table->id('id_calificacion');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->boolean('cursoFin')->nullable();
            $table->boolean('aprobado')->nullable();
            $table->string('calif')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('anio')->nullable();
            $table->unsignedBigInteger('id_institucion')->nullable();
            $table->string('urlConstancia')->nullable();
            $table->string('nombreConstancia')->nullable();
            $table->unsignedBigInteger('id_estatus')->nullable();
            $table->foreign('id_estatus')->references('id_estatus')->on('estatus');
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
        Schema::dropIfExists('calificacion');
    }
}
