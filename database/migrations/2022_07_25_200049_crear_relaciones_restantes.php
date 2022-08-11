<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearRelacionesRestantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nombramiento', function (Blueprint $table) {
            $table->foreign('empleado')->references('id')->on('users');           
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('puesto')->references('id_puesto')->on('puesto'); 
            $table->foreign('adscripcion')->references('id_adscripcion')->on('adscripcion');           
        });

        Schema::table('calificacion', function (Blueprint $table) {
            $table->foreign('empleado')->references('id')->on('users'); 
            $table->foreign('curso')->references('id_curso')->on('curso');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nombramiento', function (Blueprint $table) {
            $table->dropColumn('empleado');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('puesto');
            $table->dropColumn('adscripcion');
        });

        Schema::table('calificacion', function (Blueprint $table) {
            $table->dropColumn('empleado');
            $table->dropColumn('curso');
        });
    }
}
