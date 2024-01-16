<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Inertia\Inertia;

class ClientesController extends Controller
{
    public function index()
    {
        
        
        return Inertia::render('InformacionUsuario/Index', [
            'cliente' => Cliente::where('estado', 'aprobado')->get(),
        ]);
    }
}
