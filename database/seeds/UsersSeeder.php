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
        DB::table('users')->insert(['numEmpl'=>'1026', 'nombreCompleto' => 'NOMBRE DEL ADMINISTRADOR', 'id_puesto' => '90', 'id_adscripcion' => '1', 'id_nivel' => '3', 'id_superior' => '1' , 'ciudadAdscr' => 'CDMX', 'id_estado' => '7', 'email' => 'admin@mail.com', 'rfc' => 'RFC123', 'sexo' => '1', 'curp' => 'CURP Admin', 'fechaIngr' => '2022-02-01', 'password' => '$2y$10$PLIQJkLnWPEO9T2KH2VfWOqYPK3oNTbG1ax4FmtnX/DNWpNAec0x2', 'estatus' => '1', 'rol' => '1']);
        DB::table('users')->insert(['numEmpl'=>'1027', 'nombreCompleto' => 'NOMBRE DEL USUARIO', 'id_puesto' => '60', 'id_adscripcion' => '1', 'id_nivel' => '5', 'id_superior' => '1' , 'ciudadAdscr' => 'CDMX', 'id_estado' => '7', 'email' => 'usuario@mail.com', 'rfc' => 'RFC987', 'sexo' => '1', 'curp' => 'CURP Usuario', 'fechaIngr' => '2022-02-01', 'password' => '$2y$10$PLIQJkLnWPEO9T2KH2VfWOqYPK3oNTbG1ax4FmtnX/DNWpNAec0x2', 'estatus' => '1', 'rol' => '2']);
    }
}
