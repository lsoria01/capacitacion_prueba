<?php

use Illuminate\Database\Seeder;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituciones')->insert(['nombre'=>'CENTRO FEDERAL DE CONCILIACION Y REGISTRO LABORAL', 'tipo' => 'Federal', 'siglas' => 'CFCRL' ]);
        DB::table('instituciones')->insert(['nombre'=>'SECRETARÍA DE LA FUNCIÓN PÚBLICA', 'tipo' => 'Federal', 'siglas' => 'SFP']);
        DB::table('instituciones')->insert(['nombre'=>'CONSEJO NACIONAL PARA PREVENIR LA DISCRIMINACIÓN', 'tipo' => 'Federal', 'siglas' => 'CONAPRED' ]);
        DB::table('instituciones')->insert(['nombre'=>'INSTITUTO NACIONAL DE LAS MUJERES - .GÉNERO', 'tipo' => 'Federal', 'siglas' => 'INMUJERES' ]);
        DB::table('instituciones')->insert(['nombre'=>'SUPREMO TRIBUNAL DE JUSTICIA DEL ESTADO DE JALISCO', 'tipo' => 'Local', 'siglas' => 'STJJ' ]);
        DB::table('instituciones')->insert(['nombre'=>'COMISIÓN NACIONAL DE LOS DERECHOS HUMANOS', 'tipo' => 'Federal', 'siglas' => 'CNDH' ]);
        DB::table('instituciones')->insert(['nombre'=>'ORGANIZACIÓN INTERNACIONAL DEL TRABAJO', 'tipo' => 'Federal', 'siglas' => 'OIT' ]);
        DB::table('instituciones')->insert(['nombre'=>'INSTITUTO NACIONAL DE TRANSPARENCIA, ACCESO A LA INFORMACIÓN Y PROTECCIÓN DE DATOS PERSONALES', 'tipo' => 'Federal', 'siglas' => 'INAI']);
    }
}
