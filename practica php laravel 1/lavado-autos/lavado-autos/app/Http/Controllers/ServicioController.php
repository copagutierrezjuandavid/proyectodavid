<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function nuevo()
    {
        return view('servicios.nuevo');
    }

    public function guardar(Request $request)
    {
        Servicio::create($request->validate($this->reglas()));

        return redirect()->route('servicios')->with('exito', 'Servicio agregado.');
    }

    public function editar(Servicio $servicio)
    {
        return view('servicios.editar', compact('servicio'));
    }

    public function actualizar(Request $request, Servicio $servicio)
    {
        $servicio->update($request->validate($this->reglas()));

        return redirect()->route('servicios')->with('exito', 'Servicio actualizado.');
    }

    private function reglas(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'precio' => ['required', 'integer', 'min:1', 'max:1000'],
            'precio_camioneta' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'precio_minibus' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'precio_bus' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ];
    }
}