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
        DB::table('institucion')->insert(['descripcion'=>'SECRETARÍA DE LA FUNCIÓN PÚBLICA (SFP)' ]);
        DB::table('institucion')->insert(['descripcion'=>'CONSEJO NACIONAL PARA PREVENIR LA DISCRIMINACIÓN (CONAPRED)' ]);
        DB::table('institucion')->insert(['descripcion'=>'INSTITUTO NACIONAL DE LAS MUJERES (INMUJERES) - .GÉNERO' ]);
        DB::table('institucion')->insert(['descripcion'=>'SUPREMO TRIBUNAL DE JUSTICIA DEL ESTADO DE JALISCO' ]);
        DB::table('institucion')->insert(['descripcion'=>'COMISIÓN NACIONAL DE LOS DERECHOS HUMANOS (CNDH)' ]);
        DB::table('institucion')->insert(['descripcion'=>'ORGANIZACIÓN INTERNACIONAL DEL TRABAJO (OIT)' ]);
        DB::table('institucion')->insert(['descripcion'=>'INSTITUTO NACIONAL DE TRANSPARENCIA, ACCESO A LA INFORMACIÓN Y PROTECCIÓN DE DATOS PERSONALES (INAI)' ]);
        
        


        
    }
}
