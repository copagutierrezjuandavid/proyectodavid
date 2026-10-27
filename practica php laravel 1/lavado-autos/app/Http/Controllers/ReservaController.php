<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReservaController extends Controller
{
    private const CUPOS_POR_HORA = 3;
    private const MAX_PENDIENTES_CLIENTE = 3;

    /* ---------- PERSONAL ---------- */

    public function index(Request $request)
    {
        $todas = $request->boolean('todas');
        $fecha = $todas ? null : ($request->query('fecha') ?: today()->toDateString());
        $estado = $request->query('estado');

        $reservas = Reserva::with(['cliente', 'vehiculo', 'servicio'])
            ->when($fecha, fn ($q) => $q->whereDate('fecha', $fecha))
            ->when($estado, fn ($q) => $q->where('estado', $estado))
            ->orderByDesc('fecha')->orderBy('hora')->limit(200)->get();

        return view('reservas.index', compact('reservas', 'fecha', 'estado'));
    }

    public function crearStaff(Request $request)
    {
        return view('reservas.nueva', [
            'servicios' => Servicio::orderBy('nombre')->get(),
            'horarios' => Reserva::horarios(),
            'placa' => $request->query('placa'),
        ]);
    }

    public function guardarStaff(Request $request)
    {
        $request->merge(['placa' => Vehiculo::normalizarPlaca($request->input('placa'))]);
        $request->validate(['placa' => ['required']] + $this->reglasReserva());

        $vehiculo = Vehiculo::where('placa', $request->input('placa'))->first();
        if (! $vehiculo) {
            throw ValidationException::withMessages([
                'placa' => 'Esa placa no está registrada. Primero registra al cliente y su vehículo.',
            ]);
        }

        $reserva = $this->registrar($vehiculo, $request->only(['servicio_id', 'fecha', 'hora', 'comentario']), 'local');

        return redirect()->route('reservas.ver', $reserva)->with('exito', 'Reserva registrada.');
    }

    public function ver(Reserva $reserva)
    {
        $reserva->load(['cliente', 'vehiculo', 'servicio', 'atendidoPor']);

        return view('reservas.ver', compact('reserva'));
    }

    public function actualizar(Request $request, Reserva $reserva)
    {
        $datos = $request->validate([
            'estado' => ['required', Rule::in(array_keys(Reserva::ESTADOS))],
            'precio' => ['required', 'integer', 'min:0', 'max:1000'],
            'observacion' => ['nullable', 'string', 'max:300'],
        ]);

        $reserva->update($datos + ['atendido_por' => $request->user()->id]);

        return redirect()->route('reservas.ver', $reserva)->with('exito', 'Reserva actualizada.');
    }

    /* ---------- CLIENTE ---------- */

    public function crearCliente(Request $request)
    {
        $cliente = $request->user()->perfilCliente();

        return view('reservas.reservar', [
            'vehiculos' => $cliente->vehiculos()->orderBy('placa')->get(),
            'servicios' => Servicio::orderBy('nombre')->get(),
            'horarios' => Reserva::horarios(),
        ]);
    }

    public function guardarCliente(Request $request)
    {
        $cliente = $request->user()->perfilCliente();

        $request->validate(['vehiculo_id' => ['required', 'integer']] + $this->reglasReserva());

        $vehiculo = $cliente->vehiculos()->find($request->input('vehiculo_id'));
        if (! $vehiculo) {
            throw ValidationException::withMessages(['vehiculo_id' => 'Elige uno de tus vehículos.']);
        }

        if ($cliente->reservas()->where('estado', 'pendiente')->count() >= self::MAX_PENDIENTES_CLIENTE) {
            throw ValidationException::withMessages([
                'fecha' => 'Ya tienes ' . self::MAX_PENDIENTES_CLIENTE . ' reservas pendientes. Cancela alguna o espera a que se atiendan.',
            ]);
        }

        $this->registrar($vehiculo, $request->only(['servicio_id', 'fecha', 'hora', 'comentario']), 'web');

        return redirect()->route('panel')->with('exito', '¡Reserva enviada! Te esperamos en la fecha y hora elegidas.');
    }

    public function cancelarCliente(Request $request, Reserva $reserva)
    {
        abort_unless((int) $reserva->cliente_id === (int) $request->user()->perfilCliente()->id, 403);

        if ($reserva->estado !== 'pendiente') {
            return back()->with('error', 'Solo se pueden cancelar reservas pendientes.');
        }

        $reserva->update(['estado' => 'cancelada']);

        return back()->with('exito', 'Reserva cancelada.');
    }

    /* ---------- LÓGICA COMPARTIDA ---------- */

    private function reglasReserva(): array
    {
        return [
            'servicio_id' => ['required', 'exists:servicios,id'],
            'fecha' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['required', Rule::in(Reserva::horarios())],
            'comentario' => ['nullable', 'string', 'max:300'],
        ];
    }

    private function registrar(Vehiculo $vehiculo, array $datos, string $origen): Reserva
    {
        $fecha = Carbon::parse($datos['fecha']);
        $hora = $datos['hora'];

        if ($fecha->isSunday()) {
            throw ValidationException::withMessages(['fecha' => 'Atendemos de lunes a sábado.']);
        }

        if ($origen === 'web' && $fecha->isToday() && $hora <= now()->format('H:i')) {
            throw ValidationException::withMessages(['hora' => 'Esa hora ya pasó. Elige una hora posterior.']);
        }

        $yaTiene = Reserva::where('vehiculo_id', $vehiculo->id)
            ->whereDate('fecha', $fecha)->whereIn('estado', Reserva::ACTIVOS)->exists();
        if ($yaTiene) {
            throw ValidationException::withMessages(['fecha' => 'Este vehículo ya tiene una reserva activa ese día.']);
        }

        $ocupados = Reserva::whereDate('fecha', $fecha)->where('hora', $hora)
            ->whereIn('estado', Reserva::ACTIVOS)->count();
        if ($ocupados >= self::CUPOS_POR_HORA) {
            throw ValidationException::withMessages(['hora' => 'Esa hora ya está llena. Elige otra.']);
        }

        $servicio = Servicio::findOrFail($datos['servicio_id']);

        return Reserva::create([
            'cliente_id' => $vehiculo->cliente_id,
            'vehiculo_id' => $vehiculo->id,
            'servicio_id' => $servicio->id,
            'fecha' => $fecha->toDateString(),
            'hora' => $hora,
            'precio' => $servicio->precioPara($vehiculo->tipo),
            'comentario' => $datos['comentario'] ?? null,
            'origen' => $origen,
        ]);
    }
}