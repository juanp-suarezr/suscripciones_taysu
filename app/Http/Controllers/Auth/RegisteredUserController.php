<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AprobadoNotificacion;
use App\Models\User;
use App\Models\Roles;
use App\Models\Cliente;
use App\Models\Suscripciones;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        
        return Inertia::render('Auth/Register', [
            'clientes' => Cliente::all(),
            'paypal_token' => env('PAYPAL_TOKEN'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     * * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Cliente::class,
            'estado' => '',
            
        ]);

        
        $cliente = Cliente::create([
            'email' => $request->email,
            'name' => $request->name,
            'estado' => $request->estado,
            'identificacion' => $request->identificacion,
            'edad' => $request->edad,
            'ciudad' => $request->ciudad,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'mascota' => $request->mascota,
            'nombre_mascota' => $request->nombre_mascota,
            'cumpleanos_m' => $request->cumpleanos_m,
            'raza' => $request->raza,
            
            // Agrega cualquier otro campo necesario aquí
        ]);

        if ($cliente->estado == 'aprobado') {
            
            $fechaVencimiento = Carbon::now()->addYear();

        
            $suscripcionNow = Suscripciones::where('id_cliente', $cliente->id)->first();
        

            if (!$suscripcionNow) {

                $suscripcion = Suscripciones::create([
                    'id_cliente' => $cliente->id,
                    'fecha_vencimiento' => $fechaVencimiento,
                    'precio' => 180000,
                
                ]);

            } 

            Mail::to($cliente->email)->send(new AprobadoNotificacion($cliente));
            return redirect()->back()->with('success', 'Correo enviado con exito');

        }
    
        
        return Redirect::route('register')->with('message', true);
    


        

        

        
        
    }
}
