<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\disponibilidadController;
use App\Http\Controllers\GestionClientesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Roles;
use App\Models\User;
use App\Models\Suscripciones;
use App\Models\Cliente;
use App\Models\Disponibilidad;
use App\Models\Agendar;
use App\Models\materias;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        

    ]);
    
});



Route::get('/dashboard', function () {

    
    $clientes = Cliente::where('estado', 'aprobado')->get();
    $suscripciones = Suscripciones::all();

    return Inertia::render('Dashboard', [
        'clientes' => $clientes,
        'suscripciones' => $suscripciones,


        

    ]);
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    
    Route::get('/cumpleaños', fn () => Inertia::render('Cumpleaños', ['clientes' => Cliente::where('estado', 'aprobado')->get()]))->name('cumpleaños');
    
    Route::get('infoclientes', [ClientesController::class, 'index'])->name('infoclientes.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('aprobar', [GestionClientesController::class, 'index'])->name('aprobar.index');
    //UPDATE ESTADO CLIENTE
    Route::patch('/aprobar/{id}', [ProfileController::class, 'change'])->name('profile.change');
    //REPROBAR ESTADO CLIENTE
    Route::post('/reprobar/', [ProfileController::class, 'reprobar'])->name('profile.reprobar');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function () {
    
    
});



require __DIR__ . '/auth.php';
