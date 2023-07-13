<?php

use Illuminate\Database\Seeder;

class CalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calificaciones')->insert(['usuario_id'=>'1', 'curso_id' => '1', 'curso_fin' => '1', 'aprobado' => '1', 'calif' => '100.00', 'fecha' => '2021/02/22', 'anio' => '2022', 'estatus_id' => '2']);
        DB::table('calificaciones')->insert(['usuario_id'=>'1', 'curso_id' => '2', 'curso_fin' => '1', 'aprobado' => '1', 'calif' => '95.00', 'fecha' => '2022/07/14', 'anio' => '2022', 'estatus_id' => '2']);
        DB::table('calificaciones')->insert(['usuario_id'=>'1', 'curso_id' => '3', 'curso_fin' => '1', 'aprobado' => '1', 'calif' => '97.00', 'fecha' => '2022/01/04', 'anio' => '2022', 'estatus_id' => '2']);
    }
}
