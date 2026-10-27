@extends('layouts.base')

@section('titulo', $cliente->nombre)

@section('contenido')
  @php $cat = \App\Models\Cliente::categoria($resumen['visitas']); @endphp

  <section class="tarjeta">
    <h1>{{ $cliente->nombre }} <span class="insignia e-{{ strtolower($cat) }}">{{ $cat }}</span></h1>
    <p>Teléfono: {{ $cliente->telefono ?: '—' }} · Cuenta web: {{ $cliente->user_id ? 'Sí' : 'No' }}</p>

    <div class="stats">
      <div class="stat"><strong>{{ $resumen['visitas'] }}</strong>Lavados completados</div>
      <div class="stat"><strong>{{ $resumen['gastado'] }} Bs</strong>Total gastado</div>
      <div class="stat"><strong>{{ $resumen['ultima']?->format('d/m/Y') ?? '—' }}</strong>Última visita</div>
    </div>
  </section>

  <section class="tarjeta">
    <h2>Vehículos</h2>
    <div class="tabla-scroll">
      <table>
        <tr><th>Placa</th><th>Tipo</th><th>Marca / modelo</th><th></th></tr>
        @forelse ($cliente->vehiculos as $v)
          <tr>
            <td><strong>{{ $v->placa }}</strong></td>
            <td>{{ $v->tipoEtiqueta() }}</td>
            <td>{{ $v->marca ?: '—' }}</td>
            <td><a href="{{ route('reservas.crear', ['placa' => $v->placa]) }}" class="btn-chico">Reservar</a></td>
          </tr>
        @empty
          <tr><td colspan="4">Sin vehículos registrados.</td></tr>
        @endforelse
      </table>
    </div>

    <h3>Agregar otro vehículo</h3>
    @include('vehiculos._form', ['action' => route('vehiculos.guardar', $cliente)])
  </section>

  <section class="tarjeta">
    <h2>Historial</h2>
    <div class="tabla-scroll">
      <table>
        <tr><th>Fecha</th><th>Placa</th><th>Servicio</th><th>Bs</th><th>Estado</th><th>Comentario final</th><th></th></tr>
        @forelse ($reservas as $r)
          <tr>
            <td>{{ $r->fecha->format('d/m/Y') }} {{ $r->hora }}</td>
            <td>{{ $r->vehiculo->placa }}</td>
            <td>{{ $r->servicio->nombre }}</td>
            <td>{{ $r->precio }}</td>
            <td><span class="insignia e-{{ $r->estado }}">{{ $r->estadoEtiqueta() }}</span></td>
            <td>{{ $r->observacion ?: '—' }}</td>
            <td><a href="{{ route('reservas.ver', $r) }}" class="btn-chico">Ver</a></td>
          </tr>
        @empty
          <tr><td colspan="7">Sin reservas todavía.</td></tr>
        @endforelse
      </table>
    </div>
  </section>
@endsection