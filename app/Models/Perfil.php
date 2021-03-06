<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfil';

    protected $fillable = [
        'id',
        'nombre_perfil',        
    ];

    //Relación de uno a muchos 
    public function getUsuarios()
    {
        return $this->hasMany(User::class);
    }
}
