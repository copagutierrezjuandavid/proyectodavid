@extends('layouts.base')

@section('titulo', 'Nueva reserva')

@section('contenido')
  <section class="tarjeta">
    <h1>Nueva reserva</h1>

    <form action="{{ route('reservas.guardar') }}" method="POST">
      @csrf
      <label for="placa">Placa del vehículo</label>
      <input type="text" id="placa" name="placa" value="{{ old('placa', $placa) }}" placeholder="Ej: 1234ABC" required>
      <p class="ayuda">¿Placa nueva? <a href="{{ route('clientes.crear') }}">Registra primero al cliente y su vehículo</a>.</p>

      @include('reservas._campos')

      <button type="submit">Registrar reserva</button>
    </form>
  </section>

  <section class="tarjeta">
    <h2>Precios</h2>
    @include('publico._precios', ['editable' => false])
  </section>
@endsection