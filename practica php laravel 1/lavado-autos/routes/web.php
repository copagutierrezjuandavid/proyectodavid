<?php

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/inicio');

// ===== PÚBLICAS (la vitrina) =====
Route::get('/inicio', function () {
    return view('inicio', ['servicios' => Servicio::all()]);
})->name('inicio');

Route::get('/servicios', function () {
    return view('servicios', ['servicios' => Servicio::all()]);
})->name('servicios');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// ===== LOGIN =====
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credenciales = [
        'email'    => $request->input('email'),
        'password' => $request->input('password'),
    ];

    if (Auth::attempt($credenciales)) {
        $request->session()->regenerate();
        return redirect('/panel');
    }

    return back()->with('error', 'Correo o contraseña incorrectos.');
})->name('login.entrar');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/inicio');
})->name('logout');

// ===== PRIVADAS (candado: middleware auth) =====
Route::get('/panel', function () {
    return view('panel', ['servicios' => Servicio::all()]);
})->middleware('auth')->name('panel');

Route::get('/servicios/nuevo', function () {
    return view('servicios-nuevo');
})->middleware('auth')->name('servicios.nuevo');

Route::post('/servicios/nuevo', function (Request $request) {
    $datos = $request->validate([
        'nombre' => 'required|min:3',
        'precio' => 'required|integer|min:0',
    ], [
        'nombre.required' => 'El nombre no puede quedar vacío.',
        'nombre.min'      => 'El nombre debe tener al menos 3 letras.',
        'precio.required' => 'El precio no puede quedar vacío.',
        'precio.integer'  => 'El precio tiene que ser un número entero, sin letras.',
        'precio.min'      => 'El precio no puede ser negativo.',
    ]);

    Servicio::create($datos);

    return redirect()->route('panel')
        ->with('exito', 'Servicio guardado: ' . $datos['nombre']);
})->middleware('auth')->name('servicios.guardar');