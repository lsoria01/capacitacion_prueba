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
        DB::table('curso')->insert(['nombre'=>'VERIFICACIÓN', 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2024-01-01', 'cursoOblig' => '1', 'hrsCap' => '20', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2', 'id_institucion' => '1', 'folio' => 'VERIF22' ]);
        DB::table('curso')->insert(['nombre'=>'CLASIFICACIÓN DE LA INFORMACIÓN' , 'fecha_inicio' => '2020-03-01', 'fecha_fin' => '2023-01-01', 'cursoOblig' => '1', 'hrsCap' => '8', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2', 'id_institucion' => '2', 'folio' => 'CLAS20' ]);
        DB::table('curso')->insert(['nombre'=>'CLAVES PARA LA ATENCIÓN PÚBLICA SIN DISCRIMINACIÓN' , 'fecha_inicio' => '2021-02-01', 'fecha_fin' => '2024-01-01', 'cursoOblig' => '1', 'hrsCap' => '14', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2','id_institucion' => '3', 'folio' => 'CLAV21' ]);
        DB::table('curso')->insert(['nombre'=>'COMUNICACIÓN INCLUYENTE SIN SEXISMO' , 'fecha_inicio' => '2019-03-01', 'fecha_fin' => '2021-01-01','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2', 'id_institucion' => '4', 'folio' => 'COM19A' ]);
        DB::table('curso')->insert(['nombre'=>'CONFERENCIA MEDIACIÓN, CONSTRUCCIÓN DE PAZ Y DERECHOS HUMANOS' , 'fecha_inicio' => '2022-04-01', 'fecha_fin' => '2023-01-30','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2', 'id_institucion' => '5', 'folio' => 'CONFE2204' ]);
        DB::table('curso')->insert(['nombre'=>'CURSO BÁSICO DE DERECHOS HUMANO' , 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2023-03-30','cursoOblig' => '1', 'hrsCap' => '22', 'cursoIntExt' => '1', 'difundidoDP' => '1', 'modalidad' => 'PRESENCIAL', 'id_estatus' => '2','id_institucion' => '6', 'folio' => 'CBDH23' ]);

    }
}