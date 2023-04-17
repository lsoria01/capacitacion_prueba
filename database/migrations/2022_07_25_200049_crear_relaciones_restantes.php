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
            $table->foreign('nivel')->references('id_nivel')->on('nivel');
            $table->foreign('estado')->references('id_estado')->on('estado'); 
            $table->foreign('gradoEst')->references('id_gradoEst')->on('gradoEst');              
        });

        Schema::table('calificacion', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users'); 
            $table->foreign('id_curso')->references('id_curso')->on('curso');          
        });

        Schema::table('puesto', function (Blueprint $table) {
            $table->foreign('superior')->references('id_puesto')->on('puesto');            
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
            $table->dropColumn('nivel');
            $table->dropColumn('estado');
            $table->dropColumn('gradoEst');
        });

        Schema::table('calificacion', function (Blueprint $table) {
            $table->dropColumn('id_user');
            $table->dropColumn('id_curso');
        });

        Schema::table('puesto', function (Blueprint $table) {
            $table->dropColumn('superior');
        });
    }
}
