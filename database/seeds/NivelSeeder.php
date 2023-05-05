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
        DB::table('nivel')->insert(['nomenclatura'=>'J21', 'nombre' => 'DIRECCIÓN GENERAL' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'K12', 'nombre' => 'COORDINADOR GENERAL' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'M11', 'nombre' => 'DIRECCIÓN DE ÁREA' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'N11', 'nombre' => 'SUBDIRECCIÓN DE ÁREA' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'O11', 'nombre' => 'JEFATURA DE DEPARTAMENTO' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'P11', 'nombre' => 'ENLACE' ]);  
    }
}
