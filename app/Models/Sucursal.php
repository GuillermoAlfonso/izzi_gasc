<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursal';

    //Relación de uno a muchos 
    public function getProductos()
    {
        return $this->hasMany(Producto::class);
    }
}
