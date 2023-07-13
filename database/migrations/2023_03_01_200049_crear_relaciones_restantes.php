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
        Schema::table('nombramientos', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('usuarios');           
        });

        Schema::table('calificaciones', function (Blueprint $table) {
            $table->foreign('usuario_id')->references('id')->on('usuarios'); 
            $table->foreign('curso_id')->references('id')->on('cursos');          
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->foreign('empleado_id')->references('id')->on('empleados');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nombramientos', function (Blueprint $table) {
            $table->dropColumn('usuario_id');
        });

        Schema::table('calificaciones', function (Blueprint $table) {
            $table->dropColumn('usuario_id');
            $table->dropColumn('curso_id');
        });

        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn('empleado_id');
        });

    }
}
