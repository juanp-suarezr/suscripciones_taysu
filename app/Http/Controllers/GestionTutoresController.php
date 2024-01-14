<?php

namespace App\Http\Controllers;


use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DB;

class GestionTutoresController extends Controller
{

    public function index(Request $request)
    {
        
        return Inertia::render('GestionTutores/Index', [
            'users' => Cliente::all()
        ]);
    }

    
}
