<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['id'=>'1026', 'name' => 'LUIS DE JESÚS SORIA ZAVALA', 'id_puesto' => '90', 'id_adscripcion' => '1', 'id_nivel' => '1', 'ciudadAdscr' => 'CDMX', 'id_estado' => '7', 'email' => 'luis.soria@centrolaboral.gob.mx', 'rfc' => 'SOZL850330', 'sexo' => '1', 'curp' => 'SOZL850330HDFRVS00', 'fechaIngr' => '2022-02-01', 'password' => '$2y$10$PLIQJkLnWPEO9T2KH2VfWOqYPK3oNTbG1ax4FmtnX/DNWpNAec0x2', 'estatus' => '1', 'rol' => '1']);
    }
}
