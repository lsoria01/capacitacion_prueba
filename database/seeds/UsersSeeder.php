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
        DB::table('users')->insert(['id'=>'1026', 'name' => 'Luis de Jesús Soria Zavala', 'puesto' => '90', 'adscripcion' => '1', 'nivel' => '1', 'ciudadAdscr' => 'CDMX', 'estadoAdscr' => 'CDMX', 'email' => 'luis.soria@centrolaboral.gob.mx', 'rfc' => 'SOZL850330', 'sexo' => '1', 'curp' => 'SOZL850330HDFRVS00', 'fechaIngr' => '2022-02-01', 'password' => '$2y$10$PLIQJkLnWPEO9T2KH2VfWOqYPK3oNTbG1ax4FmtnX/DNWpNAec0x2', 'estatus' => '1']);
    }
}
