<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index(Request $request)
    {
        $usuario = $request->user();

        if ($usuario->esCliente()) {
            $cliente = $usuario->perfilCliente();
            $vehiculos = $cliente->vehiculos()->orderBy('placa')->get();
            $reservas = $cliente->reservas()->with(['vehiculo', 'servicio'])
                ->orderByDesc('fecha')->orderByDesc('hora')->get();
            $visitas = $reservas->where('estado', 'completada')->count();

            return view('panel.cliente', compact('cliente', 'vehiculos', 'reservas', 'visitas'));
        }

        $reservas = Reserva::with(['cliente', 'vehiculo', 'servicio'])
            ->whereDate('fecha', today())->orderBy('hora')->get();

        $resumen = [
            'pendientes' => $reservas->where('estado', 'pendiente')->count(),
            'proceso' => $reservas->where('estado', 'en_proceso')->count(),
            'completadas' => $reservas->where('estado', 'completada')->count(),
            'ingresos' => $reservas->where('estado', 'completada')->sum('precio'),
        ];

        return view('panel.staff', compact('reservas', 'resumen'));
    }
}