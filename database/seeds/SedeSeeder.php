<?php

use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes')->insert([ 'nombre'=> 'AGUASCALIENTES', 'estado_id' => 1]);
        DB::table('sedes')->insert([ 'nombre'=> 'TIJUANA', 'estado_id' => 2]);
        DB::table('sedes')->insert([ 'nombre'=> 'ENSENADA', 'estado_id' => 2]);
        DB::table('sedes')->insert([ 'nombre'=> 'LA PAZ', 'estado_id' => 3]);
        DB::table('sedes')->insert([ 'nombre'=> 'CIUDAD DEL CARMEN', 'estado_id' => 4]);
        DB::table('sedes')->insert([ 'nombre'=> 'CAMPECHE', 'estado_id' => 4]);
        DB::table('sedes')->insert([ 'nombre'=> 'TUXTLA GUTIÉRREZ', 'estado_id' => 5]);
        DB::table('sedes')->insert([ 'nombre'=> 'CHIHUAHUA', 'estado_id' => 6]);
        DB::table('sedes')->insert([ 'nombre'=> 'CIUDAD JUÁREZ', 'estado_id' => 6]);
        DB::table('sedes')->insert([ 'nombre'=> 'TLALPAN', 'estado_id' => 7]);
        DB::table('sedes')->insert([ 'nombre'=> 'CUAUHTÉMOC', 'estado_id' => 7]);
        DB::table('sedes')->insert([ 'nombre'=> 'TORREÓN', 'estado_id' => 8]);
        DB::table('sedes')->insert([ 'nombre'=> 'SALTILLO', 'estado_id' => 8]);
        DB::table('sedes')->insert([ 'nombre'=> 'COLIMA', 'estado_id' => 9]);
        DB::table('sedes')->insert([ 'nombre'=> 'DURANGO', 'estado_id' => 10]);
        DB::table('sedes')->insert([ 'nombre'=> 'NAUCALPAN', 'estado_id' => 11]);
        DB::table('sedes')->insert([ 'nombre'=> 'TOLUCA', 'estado_id' => 11]);
        DB::table('sedes')->insert([ 'nombre'=> 'LEÓN', 'estado_id' => 12]);
        DB::table('sedes')->insert([ 'nombre'=> 'ACAPULCO', 'estado_id' => 13]);
        DB::table('sedes')->insert([ 'nombre'=> 'PACHUCA', 'estado_id' => 14]);
        DB::table('sedes')->insert([ 'nombre'=> 'GUADALAJARA', 'estado_id' => 15]);
        DB::table('sedes')->insert([ 'nombre'=> 'MORELIA', 'estado_id' => 16]);
        DB::table('sedes')->insert([ 'nombre'=> 'CUERNAVACA', 'estado_id' => 17]);
        DB::table('sedes')->insert([ 'nombre'=> 'TEPIC', 'estado_id' => 18]);
        DB::table('sedes')->insert([ 'nombre'=> 'MONTERREY', 'estado_id' => 19]);
        DB::table('sedes')->insert([ 'nombre'=> 'OAXACA', 'estado_id' => 20]);
        DB::table('sedes')->insert([ 'nombre'=> 'PUEBLA', 'estado_id' => 21]);
        DB::table('sedes')->insert([ 'nombre'=> 'QUERÉTARO', 'estado_id' => 22]);
        DB::table('sedes')->insert([ 'nombre'=> 'CANCÚN', 'estado_id' => 23]);
        DB::table('sedes')->insert([ 'nombre'=> 'SAN LUIS POTOSÍ', 'estado_id' => 24]);
        DB::table('sedes')->insert([ 'nombre'=> 'CULIACÁN', 'estado_id' => 25]);
        DB::table('sedes')->insert([ 'nombre'=> 'HERMOSILLO', 'estado_id' => 26]);
        DB::table('sedes')->insert([ 'nombre'=> 'VILLAHERMOSA', 'estado_id' => 27]);
        DB::table('sedes')->insert([ 'nombre'=> 'CIUDAD VICTORIA', 'estado_id' => 28]);
        DB::table('sedes')->insert([ 'nombre'=> 'REYNOSA', 'estado_id' => 28]);
        DB::table('sedes')->insert([ 'nombre'=> 'TAMPICO', 'estado_id' => 28]);
        DB::table('sedes')->insert([ 'nombre'=> 'TLAXCALA', 'estado_id' => 29]);
        DB::table('sedes')->insert([ 'nombre'=> 'ORIZABA', 'estado_id' => 30]);
        DB::table('sedes')->insert([ 'nombre'=> 'VERACRUZ', 'estado_id' => 30]);
        DB::table('sedes')->insert([ 'nombre'=> 'POZA RICA', 'estado_id' => 30]);
        DB::table('sedes')->insert([ 'nombre'=> 'XALAPA', 'estado_id' => 30]);
        DB::table('sedes')->insert([ 'nombre'=> 'COATZACOALCOS', 'estado_id' => 30]);
        DB::table('sedes')->insert([ 'nombre'=> 'MÉRIDA', 'estado_id' => 31]);
        DB::table('sedes')->insert([ 'nombre'=> 'GUADALUPE', 'estado_id' => 32]);
    }
}
