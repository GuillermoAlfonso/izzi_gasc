<?php

namespace Database\Seeders;

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
        $this->call([
            perfil_seed::class,            
            categoria_seed::class,
            sucursal_seed::class,
        ]);    }
}
