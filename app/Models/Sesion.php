<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    protected $table = 'sesion';

    //Relación de muchos a uno
    public function getUsuario()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
