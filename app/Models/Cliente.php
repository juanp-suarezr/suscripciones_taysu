<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';

    protected $fillable = [
        
        'email',
        'name',
        'identificacion',
        'edad',
        'ciudad',
        'direccion',
        'telefono',
        'estado',
        'mascota',
        'nombre_mascota',
        'cumpleanos_m',
        'raza',

        // Agrega otras columnas aquí según sea necesario
    ];

}
