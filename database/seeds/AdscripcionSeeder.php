<?php

use Illuminate\Database\Seeder;

class AdscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL DE ADMINISTRACION Y FINANZAS' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACIÓN GENERAL DE ASUNTOS JURÍDICOS' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL DE CONCILIACION COLECTIVA' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL DE CONCILIACION INDIVIDUAL' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACIÓN GENERAL DE CONTRATOS COLECTIVOS' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACIÓN GENERAL DE DESARROLLO INSTITUCIONAL' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL DE REGISTRO DE ASOCIACIONES' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACIÓN GENERAL DE REGISTRO DE CONTRATOS COLECTIVOS' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL DE VERIFICACION' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'COORDINACION GENERAL TERRITORIAL' ]);
        DB::table('adscripcion')->insert(['descripcion'=>'DIRECCION GENERAL DEL CENTRO FEDERAL DE CONCILIACION Y REGISTRO LABORAL' ]);
    }
}
