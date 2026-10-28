<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::whereIn('role', ['gerente', 'cajero'])->orderBy('role')->orderBy('name')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function crear()
    {
        return view('usuarios.crear');
    }

    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'role' => ['required', Rule::in(['gerente', 'cajero'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($datos);

        return redirect()->route('usuarios.index')->with('exito', 'Usuario creado.');
    }
}