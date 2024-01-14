<?php

namespace App\Http\Controllers;

use App\Models\Suscripciones;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use Inertia\Inertia;
use Carbon\Carbon;

class suscripcionesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Suscripciones/Index', [
            'suscripciones' => suscripciones::where('estado', 'aprobado')->get(),
        ]);

    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        
        $this->validate($request, [
            'id' => '',
            'id_cliente' => 'required',
            'fecha_vencimiento' => 'required',
            'precio' => '',
            
        ]);

        $fechaVencimiento = Carbon::now()->addYear();

        $suscripciones = suscripciones::create([
        
            'id_cliente' => $request->input('id_cliente'),
            'fecha_vencimiento' => $fechaVencimiento,
            'precio' => 180000,
            
            
        ]);

    

    

    

        return Redirect::route('suscripciones.index')->with('message', true);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
{
    $suscripciones = suscripciones::find($id);

    if (!$suscripciones) {
        return Redirect::route('suscripciones.index')->with('error', 'usuario no encontrado.');
        
    }

    $suscripciones->delete();
    // return Redirect::route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    return Redirect::route('suscripciones.index');
}

}


