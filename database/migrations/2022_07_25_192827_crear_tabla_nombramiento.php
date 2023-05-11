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
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('tipo')->nullable();
            $table->date('fecEmis')->nullable();
            $table->date('fecRatif')->nullable();
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
        Schema::dropIfExists('nombramiento');
    }
}
