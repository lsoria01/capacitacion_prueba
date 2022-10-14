<?php

use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nivel')->insert(['nomenclatura'=>'N11', 'nombre' => 'Subdirección de Área' ]);
    }
}
