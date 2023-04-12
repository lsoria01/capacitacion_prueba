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
        DB::table('calificacion')->insert(['id_user'=>'1026', 'id_curso' => '1', 'cursoFin' => '1', 'aprobado' => '1', 'calif' => '100.00', 'fecha' => '2021/02/22', 'anio' => '2022', 'id_institucion' => '1', 'id_estatus' => '1']);
        DB::table('calificacion')->insert(['id_user'=>'1026', 'id_curso' => '2', 'cursoFin' => '1', 'aprobado' => '1', 'calif' => '95.00', 'fecha' => '2022/07/14', 'anio' => '2022', 'id_institucion' => '4', 'id_estatus' => '1']);
        DB::table('calificacion')->insert(['id_user'=>'1026', 'id_curso' => '3', 'cursoFin' => '1', 'aprobado' => '1', 'calif' => '97.00', 'fecha' => '2022/01/04', 'anio' => '2022', 'id_institucion' => '7', 'id_estatus' => '1']);
    }
}
