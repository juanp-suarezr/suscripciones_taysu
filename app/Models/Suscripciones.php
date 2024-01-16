<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;


class Suscripciones extends Model
{
    use HasFactory;

    protected $table = 'suscripciones';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'fecha_vencimiento',
        'precio',
        'updated_at',
        'created_at',
        
        
    ];

    public function clientes()
    {
        return $this->belongsTo(Suscripciones::class, 'id_cliente');
        
    }
    
}
