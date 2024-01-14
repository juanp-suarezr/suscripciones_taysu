<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Agendar;
use App\Models\User;
use App\Models\Roles;
use Inertia\Inertia;

class calificarController extends Controller
{
    
    public function index(Request $request)
    {
        $monitorRoleId = Roles::where('name', 'Monitor')->value('id');
        return Inertia::render('Calificar/Index', [
            'monitores' => User::where('id_rol', $monitorRoleId)->get(),
            'agendar' => agendar::where('id_estudiante', Auth::id())->where('estado', 'sinCalificar')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $monitorRoleId = Roles::where('name', 'Monitor')->value('id');
            return Inertia::render('Calificar/Edit', [
            
            
            'monitores' => User::where('id_rol', $monitorRoleId)->get(),
            'ident' => $id,
            'agendar' => Agendar::where('id', $id)->where('estado', 'sinCalificar')->get(),
            ]);
    }


    /** EDIT CALIFICACION TUTOR 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request): RedirectResponse
    {

        $monitorRoleId = Roles::where('name', 'Monitor')->value('id');
        $agendar = Agendar::find($request->input('agenda'));
        $user = User::find($request->input('id_monitor'));

         // Verificar que se encontró el usuario
        if (!$user && !$agendar) {
             // Manejar el caso donde el usuario no se encuentra
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        
        

         // Actualizar solo el estado
        \Log::info('Antes de la actualización: Usuario ID ' . $user->id . ', Calificación actual: ' . $user->calificacion);
        $user->calificacion = $request->input('calificacion');
        $user->save();
        \Log::info('Después de la actualización: Usuario ID ' . $user->id . ', Nueva calificación: ' . $user->calificacion);

        $agendar->estado = 'calificado';
        $agendar->save();

        

        return Redirect::route('calificar.index')->with('message', 'Calificación de tutor registrada con éxito');

    }


}
