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
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL DE ADMINISTRACION Y FINANZAS' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACIÓN GENERAL DE ASUNTOS JURÍDICOS' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL DE CONCILIACION COLECTIVA' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL DE CONCILIACION INDIVIDUAL' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACIÓN GENERAL DE CONTRATOS COLECTIVOS' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACIÓN GENERAL DE DESARROLLO INSTITUCIONAL' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL DE REGISTRO DE ASOCIACIONES' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACIÓN GENERAL DE REGISTRO DE CONTRATOS COLECTIVOS' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL DE VERIFICACION' ]);
        DB::table('adscripciones')->insert(['nombre'=>'COORDINACION GENERAL TERRITORIAL' ]);
        DB::table('adscripciones')->insert(['nombre'=>'DIRECCION GENERAL DEL CENTRO FEDERAL DE CONCILIACION Y REGISTRO LABORAL' ]);
    }
}
