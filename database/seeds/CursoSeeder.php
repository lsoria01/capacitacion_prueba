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
        DB::table('cursos')->insert(['nombre'=>'VERIFICACIÓN', 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2024-01-01', 'curso_oblig' => '1', 'hrs_cap' => '20', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2', 'institucion_id' => '1', 'identificador_curso' => 'VERIF22' ]);
        DB::table('cursos')->insert(['nombre'=>'CLASIFICACIÓN DE LA INFORMACIÓN' , 'fecha_inicio' => '2020-03-01', 'fecha_fin' => '2023-01-01', 'curso_oblig' => '1', 'hrs_cap' => '8', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2', 'institucion_id' => '2', 'identificador_curso' => 'CLAS20' ]);
        DB::table('cursos')->insert(['nombre'=>'CLAVES PARA LA ATENCIÓN PÚBLICA SIN DISCRIMINACIÓN' , 'fecha_inicio' => '2021-02-01', 'fecha_fin' => '2024-01-01', 'curso_oblig' => '1', 'hrs_cap' => '14', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2','institucion_id' => '3', 'identificador_curso' => 'CLAV21' ]);
        DB::table('cursos')->insert(['nombre'=>'COMUNICACIÓN INCLUYENTE SIN SEXISMO' , 'fecha_inicio' => '2019-03-01', 'fecha_fin' => '2021-01-01','curso_oblig' => '1', 'hrs_cap' => '22', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2', 'institucion_id' => '4', 'identificador_curso' => 'COM19A' ]);
        DB::table('cursos')->insert(['nombre'=>'CONFERENCIA MEDIACIÓN, CONSTRUCCIÓN DE PAZ Y DERECHOS HUMANOS' , 'fecha_inicio' => '2022-04-01', 'fecha_fin' => '2023-01-30','curso_oblig' => '1', 'hrs_cap' => '22', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2', 'institucion_id' => '5', 'identificador_curso' => 'CONFE2204' ]);
        DB::table('cursos')->insert(['nombre'=>'CURSO BÁSICO DE DERECHOS HUMANO' , 'fecha_inicio' => '2022-06-01', 'fecha_fin' => '2023-03-30','curso_oblig' => '1', 'hrs_cap' => '22', 'curso_int_ext' => '1', 'difundido_DP' => '1', 'modalidad' => 'PRESENCIAL', 'estatus_id' => '2','institucion_id' => '6', 'identificador_curso' => 'CBDH23' ]);

    }
}