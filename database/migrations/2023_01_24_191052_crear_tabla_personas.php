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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_pat')->nullable();
            $table->string('apellido_mat')->nullable();
            $table->string('nombres')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->boolean('sexo')->nullable();
            $table->unsignedBigInteger('grado_estudios_id')->nullable();
            $table->foreign('grado_estudios_id')->references('id')->on('grado_estudios');
            $table->string('nombre_grado_estudios')->nullable();
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
        Schema::dropIfExists('personas');
    }
}
