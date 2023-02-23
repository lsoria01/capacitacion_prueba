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
        DB::table('institucion')->insert(['descripcion'=>'CENTRO FEDERAL DE CONCILIACION Y REGISTRO LABORAL', 'tipo' => 'Federal', 'siglas' => 'CFCRL' ]);
        DB::table('institucion')->insert(['descripcion'=>'SECRETARÍA DE LA FUNCIÓN PÚBLICA', 'tipo' => 'Federal', 'siglas' => 'SFP']);
        DB::table('institucion')->insert(['descripcion'=>'CONSEJO NACIONAL PARA PREVENIR LA DISCRIMINACIÓN ', 'tipo' => 'Federal', 'siglas' => 'CONAPRED' ]);
        DB::table('institucion')->insert(['descripcion'=>'INSTITUTO NACIONAL DE LAS MUJERES - .GÉNERO', 'tipo' => 'Federal', 'siglas' => 'INMUJERES' ]);
        DB::table('institucion')->insert(['descripcion'=>'SUPREMO TRIBUNAL DE JUSTICIA DEL ESTADO DE JALISCO', 'tipo' => 'Local', 'siglas' => 'STJJ' ]);
        DB::table('institucion')->insert(['descripcion'=>'COMISIÓN NACIONAL DE LOS DERECHOS HUMANOS', 'tipo' => 'Federal', 'siglas' => 'CNDH' ]);
        DB::table('institucion')->insert(['descripcion'=>'ORGANIZACIÓN INTERNACIONAL DEL TRABAJO', 'tipo' => 'Federal', 'siglas' => 'OIT' ]);
        DB::table('institucion')->insert(['descripcion'=>'INSTITUTO NACIONAL DE TRANSPARENCIA, ACCESO A LA INFORMACIÓN Y PROTECCIÓN DE DATOS PERSONALES', 'tipo' => 'Federal', 'siglas' => 'INAI']);
    }
}
