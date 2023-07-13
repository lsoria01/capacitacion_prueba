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
        DB::table('niveles')->insert(['nomenclatura'=>'J21', 'nombre' => 'DIRECCIÓN GENERAL' ]);
        DB::table('niveles')->insert(['nomenclatura'=>'K12', 'nombre' => 'COORDINADOR GENERAL' ]);
        DB::table('niveles')->insert(['nomenclatura'=>'M11', 'nombre' => 'DIRECCIÓN DE ÁREA' ]);
        DB::table('niveles')->insert(['nomenclatura'=>'N11', 'nombre' => 'SUBDIRECCIÓN DE ÁREA' ]);
        DB::table('niveles')->insert(['nomenclatura'=>'O11', 'nombre' => 'JEFATURA DE DEPARTAMENTO' ]);
        DB::table('niveles')->insert(['nomenclatura'=>'P11', 'nombre' => 'ENLACE' ]);  
    }
}
