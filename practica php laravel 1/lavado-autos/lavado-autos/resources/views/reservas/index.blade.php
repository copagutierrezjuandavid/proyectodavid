@extends('layouts.base')

@section('titulo', 'Reservas')

@section('contenido')
  <section class="tarjeta">
    <h1>Reservas</h1>

    <form action="{{ route('reservas.index') }}" method="GET" class="fila-form">
      <div>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="fecha" value="{{ $fecha }}">
      </div>
      <div>
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
          <option value="">Todos</option>
          @foreach (\App\Models\Reserva::ESTADOS as $valor => $etiqueta)
            <option value="{{ $valor }}" @selected($estado === $valor)>{{ $etiqueta }}</option>
          @endforeach
        </select>
      </div>
      <div><button type="submit">Filtrar</button></div>
    </form>

    <p class="botones">
      <a href="{{ route('reservas.crear') }}" class="boton">+ Nueva reserva</a>
      <a href="{{ route('reservas.index', ['todas' => 1]) }}" class="boton boton-sec">Ver todas las fechas</a>
    </p>

    @include('reservas._tabla', ['reservas' => $reservas])
  </section>
@endsection