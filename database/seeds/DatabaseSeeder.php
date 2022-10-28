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
        $this->call(CursoSeeder::class);
        $this->call(AdscripcionSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(PuestoSeeder::class);     
        $this->call(UsersSeeder::class);      
    }
}
