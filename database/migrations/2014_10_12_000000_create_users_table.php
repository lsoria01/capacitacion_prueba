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
            $table->string('lugarAdscr')->nullable();
            $table->string('email')->nullable();
            $table->string('curp')->nullable();
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
