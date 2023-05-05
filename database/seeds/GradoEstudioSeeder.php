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
        DB::table('gradoEst')->insert(['nombre'=>'PREESCOLAR' ]);
        DB::table('gradoEst')->insert(['nombre'=>'PRIMARIA' ]);
        DB::table('gradoEst')->insert(['nombre'=>'SECUNDARIA' ]);
        DB::table('gradoEst')->insert(['nombre'=>'BACHILLERATO GENERAL' ]);
        DB::table('gradoEst')->insert(['nombre'=>'BACHILLERATO TECNOLÓGICO' ]);
        DB::table('gradoEst')->insert(['nombre'=>'LICENCIATURA' ]);
        DB::table('gradoEst')->insert(['nombre'=>'ESPECIALIZACIÓN' ]);
        DB::table('gradoEst')->insert(['nombre'=>'MAESTRÍA' ]);
        DB::table('gradoEst')->insert(['nombre'=>'DOCTORADO' ]);
    }
}
