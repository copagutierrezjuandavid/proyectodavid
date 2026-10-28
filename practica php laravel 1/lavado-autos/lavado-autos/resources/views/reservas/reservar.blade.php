@extends('layouts.base')

@section('titulo', 'Reservar')

@section('contenido')
  <section class="tarjeta">
    <h1>Reservar un lavado</h1>

    @if ($vehiculos->isEmpty())
      <p>Primero registra tu vehículo para poder reservar.</p>
      <a href="{{ route('panel') }}" class="boton">Registrar vehículo</a>
    @else
      <form action="{{ route('reservar.guardar') }}" method="POST">
        @csrf
        <label for="vehiculo_id">Tu vehículo</label>
        <select id="vehiculo_id" name="vehiculo_id" required>
          @foreach ($vehiculos as $v)
            <option value="{{ $v->id }}" @selected(old('vehiculo_id') == $v->id)>
              {{ $v->placa }} — {{ $v->tipoEtiqueta() }}
            </option>
          @endforeach
        </select>

        @include('reservas._campos')

        <p class="ayuda">Tu reserva queda <strong>pendiente</strong> hasta que te atendamos. Atendemos de lunes a sábado, de 8:00 a 18:00.</p>
        <button type="submit">Enviar reserva</button>
      </form>
    @endif
  </section>

  <section class="tarjeta">
    <h2>Precios según tu vehículo</h2>
    @include('publico._precios', ['editable' => false])
  </section>
@endsection