<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

// ---------- Públicas ----------
Route::get('/', [PublicoController::class, 'inicio'])->name('inicio');
Route::get('/servicios', [PublicoController::class, 'servicios'])->name('servicios');
Route::get('/contacto', [PublicoController::class, 'contacto'])->name('contacto');

// ---------- Solo sin sesión ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'entrar'])->middleware('throttle:6,1')->name('login.entrar');
    Route::get('/registro', [AuthController::class, 'formRegistro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.guardar');
});

// ---------- Con sesión ----------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'salir'])->name('logout');
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');

    // Solo clientes
    Route::middleware('role:cliente')->group(function () {
        Route::post('/mis-vehiculos', [VehiculoController::class, 'guardarPropio'])->name('mis-vehiculos.guardar');
        Route::get('/reservar', [ReservaController::class, 'crearCliente'])->name('reservar');
        Route::post('/reservar', [ReservaController::class, 'guardarCliente'])->name('reservar.guardar');
        Route::post('/mis-reservas/{reserva}/cancelar', [ReservaController::class, 'cancelarCliente'])->name('reservas.cancelar');
    });

    // Gerente y cajero
    Route::middleware('role:gerente,cajero')->group(function () {
        Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
        Route::get('/clientes/nuevo', [ClienteController::class, 'crear'])->name('clientes.crear');
        Route::post('/clientes', [ClienteController::class, 'guardar'])->name('clientes.guardar');
        Route::get('/clientes/{cliente}', [ClienteController::class, 'ver'])->name('clientes.ver');
        Route::post('/clientes/{cliente}/vehiculos', [VehiculoController::class, 'guardarParaCliente'])->name('vehiculos.guardar');

        Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
        Route::get('/reservas/nueva', [ReservaController::class, 'crearStaff'])->name('reservas.crear');
        Route::post('/reservas', [ReservaController::class, 'guardarStaff'])->name('reservas.guardar');
        Route::get('/reservas/{reserva}', [ReservaController::class, 'ver'])->name('reservas.ver');
        Route::put('/reservas/{reserva}', [ReservaController::class, 'actualizar'])->name('reservas.actualizar');

        // Servicios y precios (gerente y cajero)
        Route::get('/servicios/nuevo', [ServicioController::class, 'nuevo'])->name('servicios.nuevo');
        Route::post('/servicios', [ServicioController::class, 'guardar'])->name('servicios.guardar');
        Route::get('/servicios/{servicio}/editar', [ServicioController::class, 'editar'])->name('servicios.editar');
        Route::put('/servicios/{servicio}', [ServicioController::class, 'actualizar'])->name('servicios.actualizar');
    });

    // Solo gerente
    Route::middleware('role:gerente')->group(function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/nuevo', [UsuarioController::class, 'crear'])->name('usuarios.crear');
        Route::post('/usuarios', [UsuarioController::class, 'guardar'])->name('usuarios.guardar');
    });
});