<?php

use Illuminate\Database\Seeder;

class GradoEstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grado_estudios')->insert(['nombre'=>'PREESCOLAR' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'PRIMARIA' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'SECUNDARIA' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'BACHILLERATO GENERAL' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'BACHILLERATO TECNOLÓGICO' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'LICENCIATURA' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'ESPECIALIZACIÓN' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'MAESTRÍA' ]);
        DB::table('grado_estudios')->insert(['nombre'=>'DOCTORADO' ]);
    }
}
