<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(['nombre'=> 'AGUASCALIENTES']);
        DB::table('estados')->insert(['nombre'=> 'BAJA CALIFORNIA']);
        DB::table('estados')->insert(['nombre'=> 'BAJA CALIFORNIA SUR']);
        DB::table('estados')->insert(['nombre'=> 'CAMPECHE']);
        DB::table('estados')->insert(['nombre'=> 'CHIAPAS']);
        DB::table('estados')->insert(['nombre'=> 'CHIHUAHUA']);
        DB::table('estados')->insert(['nombre'=> 'CIUDAD DE MÉXICO']);
        DB::table('estados')->insert(['nombre'=> 'COAHUILA']);
        DB::table('estados')->insert(['nombre'=> 'COLIMA']);
        DB::table('estados')->insert(['nombre'=> 'DURANGO']);
        DB::table('estados')->insert(['nombre'=> 'estados DE MÉXICO']);
        DB::table('estados')->insert(['nombre'=> 'GUANAJUATO']);
        DB::table('estados')->insert(['nombre'=> 'GUERRERO']);
        DB::table('estados')->insert(['nombre'=> 'HIDALGO']);
        DB::table('estados')->insert(['nombre'=> 'JALISCO']);
        DB::table('estados')->insert(['nombre'=> 'MICHOACÁN']);
        DB::table('estados')->insert(['nombre'=> 'MORELOS']);
        DB::table('estados')->insert(['nombre'=> 'NAYARIT']);
        DB::table('estados')->insert(['nombre'=> 'NUEVO LEÓN']);
        DB::table('estados')->insert(['nombre'=> 'OAXACA']);
        DB::table('estados')->insert(['nombre'=> 'PUEBLA']);
        DB::table('estados')->insert(['nombre'=> 'QUERÉTARO']);
        DB::table('estados')->insert(['nombre'=> 'QUINTANA ROO']);
        DB::table('estados')->insert(['nombre'=> 'SAN LUIS POTOSÍ']);
        DB::table('estados')->insert(['nombre'=> 'SINALOA']);
        DB::table('estados')->insert(['nombre'=> 'SONORA']);
        DB::table('estados')->insert(['nombre'=> 'TABASCO']);
        DB::table('estados')->insert(['nombre'=> 'TAMAULIPAS']);
        DB::table('estados')->insert(['nombre'=> 'TLAXCALA']);
        DB::table('estados')->insert(['nombre'=> 'VERACRUZ']);
        DB::table('estados')->insert(['nombre'=> 'YUCATÁN']);
        DB::table('estados')->insert(['nombre'=> 'ZACATECAS']);
        DB::table('estados')->insert(['nombre'=> 'EXTRANJERO']);
    }
}
