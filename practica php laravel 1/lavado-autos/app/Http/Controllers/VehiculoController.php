<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    // El cliente agrega SU vehículo
    public function guardarPropio(Request $request)
    {
        $this->registrar($request, $request->user()->perfilCliente());

        return redirect()->route('panel')->with('exito', 'Vehículo registrado.');
    }

    // El personal agrega un vehículo a un cliente
    public function guardarParaCliente(Request $request, Cliente $cliente)
    {
        $this->registrar($request, $cliente);

        return redirect()->route('clientes.ver', $cliente)->with('exito', 'Vehículo registrado.');
    }

    private function registrar(Request $request, Cliente $cliente): void
    {
        $request->merge(['placa' => Vehiculo::normalizarPlaca($request->input('placa'))]);
        $datos = $request->validate(Vehiculo::reglas());
        $cliente->vehiculos()->create($datos);
    }
}