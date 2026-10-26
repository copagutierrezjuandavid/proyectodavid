<?php

use App\Models\Mensaje;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/inicio');

// ---------- Inicio ----------
Route::get('/inicio', function () {
    $servicios = [
        ['nombre' => 'Lavado básico',   'precio' => '18 Bs'],
        ['nombre' => 'Lavado completo', 'precio' => '50 Bs'],
        ['nombre' => 'Lavado de motor', 'precio' => 'Consultar'],
        ['nombre' => 'Encerado',        'precio' => 'Consultar'],
        ['nombre' => 'Aspirado',        'precio' => 'Consultar'],
    ];

    return view('inicio', ['servicios' => $servicios]);
})->name('inicio');

// ---------- Contacto (solo información) ----------
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// ---------- Servicios ----------
// Muestra TODOS los registros guardados
Route::get('/servicios', function () {
    return view('servicios', ['registros' => Mensaje::orderByDesc('id')->get()]);
})->name('servicios');

// Un solo botón "Guardar": guarda todo
Route::post('/servicios', function (Request $request) {
    $datos = $request->validate([
        'nombre_servicio' => 'required|min:3',
        'precio'          => 'required|integer|min:0',
        'nombre'          => 'required|min:3',
        'correo'          => 'required|email',
        'telefono'        => 'required|digits_between:7,8',
        'mensaje'         => 'nullable|max:500',
    ], [
        'nombre_servicio.required' => 'Falta el nombre del servicio.',
        'nombre_servicio.min'      => 'El nombre del servicio debe tener al menos 3 letras.',
        'precio.required'          => 'Falta el precio.',
        'precio.integer'           => 'El precio debe ser un número entero, sin decimales.',
        'precio.min'               => 'El precio no puede ser negativo.',
        'nombre.required'          => 'Falta tu nombre.',
        'nombre.min'               => 'Tu nombre debe tener al menos 3 letras.',
        'correo.required'          => 'Falta tu correo.',
        'correo.email'             => 'Ese correo no es válido. Ejemplo: tunombre@gmail.com',
        'telefono.required'        => 'Falta tu teléfono.',
        'telefono.digits_between'  => 'El teléfono debe tener 7 u 8 números.',
        'mensaje.max'              => 'El mensaje es muy largo (máximo 500 caracteres).',
    ]);

    // INSERT 1: tabla servicios
    Servicio::create([
        'nombre' => $datos['nombre_servicio'],
        'precio' => $datos['precio'],
    ]);

    // INSERT 2: tabla mensajes (con todos los datos)
    Mensaje::create([
        'servicio' => $datos['nombre_servicio'],
        'precio'   => $datos['precio'],
        'nombre'   => $datos['nombre'],
        'correo'   => $datos['correo'],
        'telefono' => $datos['telefono'],
        'mensaje'  => $datos['mensaje'] ?? null,
    ]);

    return redirect()->route('servicios')
        ->with('exito', 'Servicio guardado: ' . $datos['nombre_servicio']);
})->name('servicios.guardar');