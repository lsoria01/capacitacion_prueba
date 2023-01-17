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
        DB::table('nivel')->insert(['nomenclatura'=>'J21', 'nombre' => 'Dirección General' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'K12', 'nombre' => 'Coordinador General' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'M11', 'nombre' => 'Dirección de Área' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'N11', 'nombre' => 'Subdirección de Área' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'O11', 'nombre' => 'Jefatura de Departamento' ]);
        DB::table('nivel')->insert(['nomenclatura'=>'P11', 'nombre' => 'Enlace' ]);  
    }
}
