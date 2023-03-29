<?php

use Illuminate\Database\Seeder;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatus')->insert(['nombre'=> 'Registrado']);
        DB::table('estatus')->insert(['nombre'=> 'Validado']);
    }
}
