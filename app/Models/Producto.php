<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'sucursal_id',
        'precio',
        'fecha_compra',
        'comentarios',
        'estado'
    ];

    protected $casts = [
        'fecha_compra' => 'datetime:YYYY-mm-dd',
      ];

    //Relación de muchos a uno
    public function getCategoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    //Relación de muchos a uno
    public function getSucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
