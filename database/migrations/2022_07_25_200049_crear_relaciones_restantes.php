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
            $table->foreign('id_puesto')->references('id_puesto')->on('puesto'); 
            $table->foreign('id_adscripcion')->references('id_adscripcion')->on('adscripcion'); 
            $table->foreign('id_nivel')->references('id_nivel')->on('nivel');
            $table->foreign('id_estado')->references('id_estado')->on('estado'); 
            $table->foreign('id_gradoEst')->references('id_gradoEst')->on('gradoEst');              
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
            $table->dropColumn('id_puesto');
            $table->dropColumn('id_adscripcion');
            $table->dropColumn('id_nivel');
            $table->dropColumn('id_estado');
            $table->dropColumn('id_gradoEst');
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
