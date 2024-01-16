<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;
use Illuminate\Support\Facades\Mail;
use App\Mail\FelizCumpleanos;

class EnviarCorreosCumpleanos extends Command
{
    protected $signature = 'enviar:correos-cumpleanos';
    protected $description = 'Enviar correos a usuarios cuyo cumpleaños es hoy.';

    public function handle()
    {
        $mascotasCumpleanos = Cliente::whereRaw('DAYOFMONTH(cumpleanos_m) = DAYOFMONTH(NOW()) AND MONTH(cumpleanos_m) = MONTH(NOW())')
            ->get();

        foreach ($mascotasCumpleanos as $usuario) {
            // Envía un correo al usuario
            Mail::to($usuario->email)->send(new FelizCumpleanos($usuario));
        }

        $this->info('Correos enviados correctamente.');
    }
}

