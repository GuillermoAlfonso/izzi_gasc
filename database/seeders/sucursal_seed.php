<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sucursal_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Cuernavaca', 'Yautepec', 'Cuautla', 'Acapulco'];        
        for ($i=0; $i < 4; $i++) { 
            DB::table('sucursal')->insert(array(
                'nombre_sucursal' => $data[$i]
            ));
        }        
    }
}
