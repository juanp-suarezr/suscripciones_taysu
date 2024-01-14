<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendar extends Model
{
    use HasFactory;

    protected $table = 'agendamiento';

    public $timestamps = false;

    protected $fillable = [
        'id_estudiante',
        'id_monitor',
        'id_materia',
        'start',
        'end',
        'titulo',
        'estado',
        
        
    ];

    public function estudiante()
    {
        return $this->belongsTo(Agendar::class, 'id_estudiante');
        
    }
}
