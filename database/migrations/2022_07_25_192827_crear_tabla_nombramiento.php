<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaNombramiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nombramiento', function (Blueprint $table) {
            $table->id('id_nombramiento');
            $table->unsignedBigInteger('empleado')->nullable();
            $table->string('tipo')->nullable();
            $table->date('fecEmis')->nullable();
            $table->date('fecRatif')->nullable();
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
        Schema::dropIfExists('nombramiento');
    }
}
