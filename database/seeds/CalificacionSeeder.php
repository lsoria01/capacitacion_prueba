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
        DB::table('calificacion')->insert(['empleado'=>'1026', 'curso' => '1', 'cursoFin' => '1', 'aprobado' => '1', 'cursoOblig' => '1', 'calif' => '100.00', 'hrsCap' => '20', 'fecha' => '2021/02/22', 'anio' => '2022', 'cursoIntExt' => '1', 'id_institucion' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial']);
        DB::table('calificacion')->insert(['empleado'=>'1026', 'curso' => '2', 'cursoFin' => '1', 'aprobado' => '1', 'cursoOblig' => '1', 'calif' => '95.00', 'hrsCap' => '8', 'fecha' => '2022/07/14', 'anio' => '2022', 'cursoIntExt' => '1', 'id_institucion' => '4', 'difundidoDP' => '1', 'modalidad' => 'presencial']);
        DB::table('calificacion')->insert(['empleado'=>'1026', 'curso' => '3', 'cursoFin' => '1', 'aprobado' => '1', 'cursoOblig' => '1', 'calif' => '97.00', 'hrsCap' => '14', 'fecha' => '2022/01/04', 'anio' => '2022', 'cursoIntExt' => '1', 'id_institucion' => '7', 'difundidoDP' => '1', 'modalidad' => 'presencial']);
    }
}
