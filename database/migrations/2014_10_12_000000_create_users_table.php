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
            $table->string('name')->nullable();
            $table->unsignedBigInteger('puesto')->nullable();
            $table->unsignedBigInteger('adscripcion')->nullable();
            $table->unsignedBigInteger('nivel')->nullable();
            $table->string('ciudadAdscr')->nullable();
            $table->string('estadoAdscr')->nullable();
            $table->string('email')->nullable();
            $table->string('rfc')->nullable();
            $table->boolean('sexo')->nullable();
            $table->string('curp')->nullable();
            $table->string('gradoEstud')->nullable();
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
