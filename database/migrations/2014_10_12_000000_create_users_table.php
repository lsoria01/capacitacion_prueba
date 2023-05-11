<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('numEmpl')->nullable();
            $table->string('nombreCompleto')->nullable();
            $table->unsignedBigInteger('id_puesto')->nullable();
            $table->unsignedBigInteger('id_adscripcion')->nullable();
            $table->unsignedBigInteger('id_nivel')->nullable();
            $table->unsignedBigInteger('id_superior')->nullable();
            $table->string('ciudadAdscr')->nullable();
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->string('email')->nullable();
            $table->string('rfc')->nullable();
            $table->boolean('sexo')->nullable();
            $table->string('curp')->nullable();
            $table->unsignedBigInteger('id_gradoEst')->nullable();
            $table->string('descripEstud')->nullable();
            $table->date('fechaIngr')->nullable();
            $table->string('password')->nullable();
            $table->string('indicio')->nullable();
            $table->boolean('estatus')->nullable();
            $table->integer('rol')->nullable();
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
        Schema::dropIfExists('users');
    }
}
