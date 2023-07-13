<?php

use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert(['num_empleado' => '1026', 'persona_id' => '1', 'fecha_ingr' => '2022-02-01' ,'nivel_id' => '4', 'puesto_id' => '90' , 'adscripcion_id' => '1', 'estado_id' => '7', 'ciudad_adscripcion' => 'CDMX', 'empleado_id' => '1']);
    }
}
