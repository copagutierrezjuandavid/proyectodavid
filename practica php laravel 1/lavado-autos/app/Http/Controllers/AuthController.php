<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function entrar(Request $request)
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($datos)) {
            $request->session()->regenerate();
            return redirect()->intended(route('panel'));
        }

        return back()->withInput($request->only('email'))->with('error', 'Correo o contraseña incorrectos.');
    }

    public function formRegistro()
    {
        return view('auth.registro');
    }

    // Registro público: SIEMPRE crea un cliente (el rol nunca viene del formulario)
    public function registrar(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'telefono' => ['required', 'digits_between:7,8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario = DB::transaction(function () use ($datos) {
            $usuario = User::create([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'telefono' => $datos['telefono'],
                'password' => $datos['password'],
                'role' => 'cliente',
            ]);

            Cliente::create([
                'user_id' => $usuario->id,
                'nombre' => $datos['name'],
                'telefono' => $datos['telefono'],
            ]);

            return $usuario;
        });

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->route('panel')->with('exito', '¡Cuenta creada! Registra tu vehículo para poder reservar.');
    }

    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }
}