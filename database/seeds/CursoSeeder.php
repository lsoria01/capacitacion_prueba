<?php

use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curso')->insert(['nombre'=>'Verificacion' ]);
        DB::table('curso')->insert(['nombre'=>'Clasificación de la información' ]);
        DB::table('curso')->insert(['nombre'=>'Claves para la atención pública sin discriminación' ]);
        DB::table('curso')->insert(['nombre'=>'Comunicación incluyente sin sexismo' ]);
        DB::table('curso')->insert(['nombre'=>'Conferencia mediación, construcción de paz y derechos humanos' ]);
        DB::table('curso')->insert(['nombre'=>'Curso básico de derechos humanos' ]);

    }
}
