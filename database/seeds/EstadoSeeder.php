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
        DB::table('estado')->insert(['nombre'=> 'AGUASCALIENTES']);
        DB::table('estado')->insert(['nombre'=> 'BAJA CALIFORNIA']);
        DB::table('estado')->insert(['nombre'=> 'BAJA CALIFORNIA SUR']);
        DB::table('estado')->insert(['nombre'=> 'CAMPECHE']);
        DB::table('estado')->insert(['nombre'=> 'CHIAPAS']);
        DB::table('estado')->insert(['nombre'=> 'CHIHUAHUA']);
        DB::table('estado')->insert(['nombre'=> 'CIUDAD DE MÉXICO']);
        DB::table('estado')->insert(['nombre'=> 'COAHUILA']);
        DB::table('estado')->insert(['nombre'=> 'COLIMA']);
        DB::table('estado')->insert(['nombre'=> 'DURANGO']);
        DB::table('estado')->insert(['nombre'=> 'ESTADO DE MÉXICO']);
        DB::table('estado')->insert(['nombre'=> 'GUANAJUATO']);
        DB::table('estado')->insert(['nombre'=> 'GUERRERO']);
        DB::table('estado')->insert(['nombre'=> 'HIDALGO']);
        DB::table('estado')->insert(['nombre'=> 'JALISCO']);
        DB::table('estado')->insert(['nombre'=> 'MICHOACÁN']);
        DB::table('estado')->insert(['nombre'=> 'MORELOS']);
        DB::table('estado')->insert(['nombre'=> 'NAYARIT']);
        DB::table('estado')->insert(['nombre'=> 'NUEVO LEÓN']);
        DB::table('estado')->insert(['nombre'=> 'OAXACA']);
        DB::table('estado')->insert(['nombre'=> 'PUEBLA']);
        DB::table('estado')->insert(['nombre'=> 'QUERÉTARO']);
        DB::table('estado')->insert(['nombre'=> 'QUINTANA ROO']);
        DB::table('estado')->insert(['nombre'=> 'SAN LUIS POTOSÍ']);
        DB::table('estado')->insert(['nombre'=> 'SINALOA']);
        DB::table('estado')->insert(['nombre'=> 'SONORA']);
        DB::table('estado')->insert(['nombre'=> 'TABASCO']);
        DB::table('estado')->insert(['nombre'=> 'TAMAULIPAS']);
        DB::table('estado')->insert(['nombre'=> 'TLAXCALA']);
        DB::table('estado')->insert(['nombre'=> 'VERACRUZ']);
        DB::table('estado')->insert(['nombre'=> 'YUCATÁN']);
        DB::table('estado')->insert(['nombre'=> 'ZACATECAS']);
        DB::table('estado')->insert(['nombre'=> 'EXTRANJERO']);
    }
}
