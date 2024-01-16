<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Suscripciones;
use App\Mail\AprobadoNotificacion;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $id = $request->input('id');
        $originPage = $request->input('originPage');

        return Inertia::render('Profile/Edit', [
            'id_user' => $id,
            'originPage' => $originPage,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'clientes' => Cliente::where('id', $id)->where('estado', 'aprobado')->get(),
            'informacion_usuarioID' => User::where('id', Auth::id())->get(),
            
        ]);
    }

    /**
     * Update the user's profile information.
     * @param  Object  $rules
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $originPage = $request->input('originPage');
        $userId = $request->input('id');

        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
        ];


        if (auth()->id() != $userId) {
            $rules['email'][] = 'required';
        }

        $request->user()->fill($request->validate($rules));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($originPage == 'UsuariosEdit') {

            $User = $request->user();
            $User->fill($request->only(['email', 'name']));

            $request->user()->save();
            $informacionUsuario = $User->infoUser;
            $informacionUsuario->id_usuario = $request->input('id');
            $informacionUsuario->email = $request->input('email');
            $informacionUsuario->name = $request->input('name');
            $informacionUsuario->save();
        } else {

            $User = $request->user();
            $informacionUsuario = $User->infoUser;
            $informacionUsuario->id_usuario = $request->input('id');
            $informacionUsuario->email = $request->input('email');
            $informacionUsuario->name = $request->input('name');
            $informacionUsuario->identificacion = $request->input('identificacion');
            $informacionUsuario->edad = $request->input('edad');
            $informacionUsuario->ciudad = $request->input('ciudad');
            $informacionUsuario->facultad = $request->input('facultad');
            $informacionUsuario->semestre = $request->input('semestre');
            $request->user()->save();
            $informacionUsuario->save();
        }

        return Redirect('/profile?id=' . urlencode($request->input('id')) . '&originPage=' . urlencode($originPage))->with('success', 'Perfil actualizado exitosamente.');
    }

    /** EDIT ESTADO CLIENTE -- APROBADO
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function change($id): RedirectResponse
    {

        $user = Cliente::find($id);
        
        
        // Verificar que se encontró el usuario
        if (!$user) {
            // Manejar el caso donde el usuario no se encuentra
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        // Actualizar solo el estado
        $user->estado = 'aprobado';
        $user->save();

        $fechaVencimiento = Carbon::now()->addYear();

        
        $suscripcionNow = Suscripciones::where('id_cliente', $user->id)->first();
        

        if (!$suscripcionNow) {

            $suscripcion = Suscripciones::create([
                'id_cliente' => $user->id,
                'fecha_vencimiento' => $fechaVencimiento,
                'precio' => 180000,
                
            ]);

            

        } 


        Mail::to($user->email)->send(new AprobadoNotificacion($user));
        return redirect()->back()->with('success', 'Correo enviado con exito');

    }

    /** REPROBAR TUTOR 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reprobar($id): RedirectResponse
    {

        $user = Cliente::find($id);

        // Verificar que se encontró el usuario
        if (!$user) {
            // Manejar el caso donde el usuario no se encuentra
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        // Actualizar solo el estado
        $user->estado = 'denegado';
        $user->save();

        
        Mail::to($user->email)->send(new AprobadoNotificacion($user));
        return redirect()->back()->with('success', 'Correo enviado con exito');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
