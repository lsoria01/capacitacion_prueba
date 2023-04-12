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
        DB::table('curso')->insert(['nombre'=>'Verificacion', 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2024-01-01', 'cursoOblig' => '1', 'hrsCap' => '20', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1', 'id_institucion' => '1', 'folio' => 'VERIF22' ]);
        DB::table('curso')->insert(['nombre'=>'Clasificación de la información' , 'fecha_inicio' => '2020-03-01', 'fecha_fin' => '2023-01-01', 'cursoOblig' => '1', 'hrsCap' => '8', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1', 'id_institucion' => '2', 'folio' => 'CLAS20' ]);
        DB::table('curso')->insert(['nombre'=>'Claves para la atención pública sin discriminación' , 'fecha_inicio' => '2021-02-01', 'fecha_fin' => '2024-01-01', 'cursoOblig' => '1', 'hrsCap' => '14', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1','id_institucion' => '3', 'folio' => 'CLAV21' ]);
        DB::table('curso')->insert(['nombre'=>'Comunicación incluyente sin sexismo' , 'fecha_inicio' => '2019-03-01', 'fecha_fin' => '2021-01-01','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1', 'id_institucion' => '4', 'folio' => 'COM19A' ]);
        DB::table('curso')->insert(['nombre'=>'Conferencia mediación, construcción de paz y derechos humanos' , 'fecha_inicio' => '2022-04-01', 'fecha_fin' => '2023-01-30','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1', 'id_institucion' => '5', 'folio' => 'CONFE2204' ]);
        DB::table('curso')->insert(['nombre'=>'Curso básico de derechos humanos' , 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2023-03-30','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'presencial', 'id_estatus' => '1','id_institucion' => '6', 'folio' => 'CBDH23' ]);

    }
}
