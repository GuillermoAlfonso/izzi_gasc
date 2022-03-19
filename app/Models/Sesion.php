<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'sesion';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'fecha_sesion',
        'usuario_id',
    ];

    //Relación de muchos a uno
    public function getUsuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
