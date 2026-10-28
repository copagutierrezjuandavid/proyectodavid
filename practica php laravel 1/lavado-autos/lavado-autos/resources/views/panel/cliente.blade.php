@extends('layouts.base')

@section('titulo', 'Mi cuenta')

@section('contenido')
  <section class="tarjeta">
    <h1>Hola, {{ auth()->user()->name }} 👋</h1>
    <p>
      Lavados completados: <strong>{{ $visitas }}</strong>
      @if ($visitas >= 5)
        <span class="insignia e-frecuente">Cliente frecuente</span>
      @endif
    </p>
    <a href="{{ route('reservar') }}" class="boton">Reservar un lavado</a>
  </section>

  <section class="tarjeta">
    <h2>Mis vehículos</h2>
    @if ($vehiculos->isEmpty())
      <p>Aún no registraste ningún vehículo. Agrega uno para poder reservar.</p>
    @else
      <div class="tabla-scroll">
        <table>
          <tr><th>Placa</th><th>Tipo</th><th>Marca / modelo</th></tr>
          @foreach ($vehiculos as $v)
            <tr>
              <td><strong>{{ $v->placa }}</strong></td>
              <td>{{ $v->tipoEtiqueta() }}</td>
              <td>{{ $v->marca ?: '—' }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    @endif

    <h3>Agregar vehículo</h3>
    @include('vehiculos._form', ['action' => route('mis-vehiculos.guardar')])
  </section>

  <section class="tarjeta">
    <h2>Mis reservas</h2>
    <div class="tabla-scroll">
      <table>
        <tr><th>Fecha</th><th>Hora</th><th>Vehículo</th><th>Servicio</th><th>Bs</th><th>Estado</th><th></th></tr>
        @forelse ($reservas as $r)
          <tr>
            <td>{{ $r->fecha->format('d/m/Y') }}</td>
            <td>{{ $r->hora }}</td>
            <td>{{ $r->vehiculo->placa }}</td>
            <td>{{ $r->servicio->nombre }}</td>
            <td>{{ $r->precio }}</td>
            <td><span class="insignia e-{{ $r->estado }}">{{ $r->estadoEtiqueta() }}</span></td>
            <td>
              @if ($r->estado === 'pendiente')
                <form action="{{ route('reservas.cancelar', $r) }}" method="POST" class="form-inline"
                      onsubmit="return confirm('¿Cancelar esta reserva?')">
                  @csrf
                  <button type="submit" class="btn-chico btn-peligro">Cancelar</button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr><td colspan="7">Todavía no tienes reservas.</td></tr>
        @endforelse
      </table>
    </div>
  </section>
@endsection