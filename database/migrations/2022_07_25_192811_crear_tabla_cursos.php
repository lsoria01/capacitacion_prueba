<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            /*******/
            //nuevos campos
            $table->boolean('curso_oblig')->nullable();
            $table->integer('hrs_cap')->nullable();
            $table->boolean('curso_int_ext')->nullable();
            $table->boolean('difundido_DP')->nullable();
            $table->string('modalidad')->nullable();
            $table->unsignedBigInteger('estatus_id')->nullable();
            $table->foreign('estatus_id')->references('id')->on('estatus');
            /*******/
            $table->unsignedBigInteger('institucion_id')->nullable();
            $table->foreign('institucion_id')->references('id')->on('instituciones');
            $table->string('identificador_curso')->nullable();
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
        Schema::dropIfExists('cursos');
    }
}
