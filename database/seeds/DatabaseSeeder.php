<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(EstatusSeeder::class); 
        $this->call(AdscripcionSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(PuestoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(InstitucionSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(GradoEstudioSeeder::class);      
        $this->call(PersonaSeeder::class);  
        $this->call(EmpleadoSeeder::class);  
        $this->call(UsuarioSeeder::class);    
        $this->call(CalificacionSeeder::class); 
    }
}
