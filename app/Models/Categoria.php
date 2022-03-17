<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    //Relación de uno a muchos 
    public function getProductos(){
        return $this->hasMany(Producto::class);
    }
}
