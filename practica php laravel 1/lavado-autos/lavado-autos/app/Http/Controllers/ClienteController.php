<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $clientes = Cliente::query()
            ->withCount([
                'vehiculos',
                'reservas as visitas' => fn ($r) => $r->where('estado', 'completada'),
            ])
            ->when($q !== '', function ($query) use ($q) {
                $placa = Vehiculo::normalizarPlaca($q);
                $query->where(function ($w) use ($q, $placa) {
                    $w->where('nombre', 'like', "%{$q}%")->orWhere('telefono', 'like', "%{$q}%");
                    if ($placa !== '') {
                        $w->orWhereHas('vehiculos', fn ($v) => $v->where('placa', 'like', "%{$placa}%"));
                    }
                });
            })
            ->orderBy('nombre')->limit(100)->get();

        return view('clientes.index', compact('clientes', 'q'));
    }

    public function crear()
    {
        return view('clientes.crear');
    }

    // Registra al dueño y su primer vehículo en un solo paso
    public function guardar(Request $request)
    {
        $request->merge(['placa' => Vehiculo::normalizarPlaca($request->input('placa'))]);

        $datos = $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:100'],
            'telefono' => ['nullable', 'digits_between:7,8'],
        ] + Vehiculo::reglas());

        $cliente = DB::transaction(function () use ($datos) {
            $cliente = Cliente::create([
                'nombre' => $datos['nombre'],
                'telefono' => $datos['telefono'] ?? null,
            ]);
            $cliente->vehiculos()->create([
                'placa' => $datos['placa'],
                'tipo' => $datos['tipo'],
                'marca' => $datos['marca'] ?? null,
            ]);
            return $cliente;
        });

        return redirect()->route('clientes.ver', $cliente)->with('exito', 'Cliente y vehículo registrados.');
    }

    public function ver(Cliente $cliente)
    {
        $cliente->load('vehiculos');
        $reservas = $cliente->reservas()->with(['vehiculo', 'servicio'])
            ->orderByDesc('fecha')->orderByDesc('hora')->get();

        $completadas = $reservas->where('estado', 'completada');
        $resumen = [
            'visitas' => $completadas->count(),
            'gastado' => $completadas->sum('precio'),
            'ultima' => $completadas->first()?->fecha,
        ];

        return view('clientes.ver', compact('cliente', 'reservas', 'resumen'));
    }
}