<?php

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert(['apellido_pat'=>'Soria', 'apellido_mat' => 'Zavala', 'nombres' => 'Luis de Jesús', 'rfc' => 'ABC123456', 'curp' => '123456789ABC', 'sexo' => '1', 'grado_estudios_id' => '6', 'nombre_grado_estudios' => 'Informática']);
    }
}
