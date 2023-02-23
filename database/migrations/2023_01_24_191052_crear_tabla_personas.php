<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPersonas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('apellidoPat')->nullable();
            $table->string('apellidoMat')->nullable();
            $table->string('nombres')->nullable();
            $table->string('rfc')->nullable();
            $table->string('CURP')->nullable();
            $table->string('sexo')->nullable();
            $table->string('gradoEst')->nullable();
            $table->string('nombreGradoEst')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
