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
            $table->decimal('calif', 10,2)->nullable();
            $table->integer('hrsCap')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('anio')->nullable();
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
        Schema::dropIfExists('calificacion');
    }
}
