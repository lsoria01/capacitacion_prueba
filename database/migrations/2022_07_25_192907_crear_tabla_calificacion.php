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
            $table->unsignedBigInteger('empleado')->nullable();
            $table->unsignedBigInteger('curso')->nullable();
            $table->boolean('cursoFin')->nullable();
            $table->boolean('aprobado')->nullable();
            $table->boolean('cursoOblig')->nullable();
            $table->string('calif')->nullable();
            $table->integer('hrsCap')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('anio')->nullable();
            $table->boolean('cursoIntExt')->nullable();
            $table->unsignedBigInteger('id_institucion')->nullable();
            $table->boolean('difundidoDP')->nullable();
            $table->string('modalidad')->nullable();
            $table->integer('estatus')->nullable();
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
