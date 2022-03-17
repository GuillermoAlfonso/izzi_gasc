<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class perfil_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Capturista', 'Gestor', 'Administrador'];
        for ($i=0; $i < 3; $i++) { 
            DB::table('perfil')->insert(array(
                'nombre_perfil' => $data[$i]
            ));
        }
    }
}
