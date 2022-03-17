<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoria_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Electrónica', 'Línea Blanca', 'Deportes', 'Alimentos', 'Jardín'];        
        for ($i=0; $i < 5; $i++) { 
            DB::table('categoria')->insert(array(
                'nombre_categoria' => $data[$i]
            ));
        }
    }
}
