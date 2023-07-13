<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert(['persona_id'=> '1', 'correo' => 'luis.soria@centrolaboral.gob.mx', 'usuario' => 'CURP Admin', 'password' => '$2y$10$PLIQJkLnWPEO9T2KH2VfWOqYPK3oNTbG1ax4FmtnX/DNWpNAec0x2', 'rol' => '1', 'estatus' => '1'  ]);
    }
}
