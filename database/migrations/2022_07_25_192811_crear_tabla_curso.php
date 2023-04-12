<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->id('id_curso');
            $table->string('nombre')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            /*******/
            //nuevos campos
            $table->boolean('cursoOblig')->nullable();
            $table->integer('hrsCap')->nullable();
            $table->boolean('cursoIntExt')->nullable();
            $table->boolean('difundidoDP')->nullable();
            $table->string('modalidad')->nullable();
            $table->unsignedBigInteger('id_estatus')->nullable();
            $table->foreign('id_estatus')->references('id_estatus')->on('estatus');
            /*******/
            $table->unsignedBigInteger('id_institucion')->nullable();
            $table->foreign('id_institucion')->references('id_institucion')->on('institucion');
            $table->string('folio')->nullable();
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
        Schema::dropIfExists('curso');
    }
}
