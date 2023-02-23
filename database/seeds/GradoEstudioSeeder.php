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
        DB::table('gradoEst')->insert(['nombre'=>'Preescolar' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Primaria' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Secundaria' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Bachillerato General' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Bachillerato Tecnológico' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Licenciatura' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Especialización' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Maestría' ]);
        DB::table('gradoEst')->insert(['nombre'=>'Doctorado' ]);
    }
}
