@extends('layouts.base')

@section('titulo', 'Panel')

@section('contenido')
  <section class="tarjeta">
    <h1>Hola, {{ auth()->user()->name }}</h1>
    <p>Sesión iniciada como <strong>{{ auth()->user()->rolEtiqueta() }}</strong> · {{ now()->format('d/m/Y') }}</p>

    <div class="stats">
      <div class="stat"><strong>{{ $resumen['pendientes'] }}</strong>Pendientes hoy</div>
      <div class="stat"><strong>{{ $resumen['proceso'] }}</strong>En proceso</div>
      <div class="stat"><strong>{{ $resumen['completadas'] }}</strong>Completadas</div>
      @if (auth()->user()->esGerente())
        <div class="stat"><strong>{{ $resumen['ingresos'] }} Bs</strong>Ingresos de hoy</div>
      @endif
    </div>

    <p class="botones">
      <a href="{{ route('reservas.crear') }}" class="boton">+ Nueva reserva</a>
      <a href="{{ route('clientes.crear') }}" class="boton boton-sec">+ Registrar cliente</a>
      <a href="{{ route('servicios') }}" class="boton boton-sec">Servicios y precios</a>
      @if (auth()->user()->esGerente())
        <a href="{{ route('usuarios.crear') }}" class="boton boton-sec">+ Nuevo usuario</a>
      @endif
    </p>
  </section>

  <section class="tarjeta">
    <h2>Reservas de hoy</h2>
    @include('reservas._tabla', ['reservas' => $reservas])
  </section>
@endsection