@extends('layouts.base')

@section('titulo', 'Inicio')

@section('contenido')
  <section class="tarjeta">
    <h1>Tu auto limpio, rápido y a buen precio</h1>
    <p>
      En Lavado de Autos Apaza cuidamos la limpieza y el aspecto de tu vehículo.
      Atendemos a clientes particulares, propietarios de vehículos de transporte
      y flotas pequeñas de la ciudad de Oruro.
    </p>
    <p class="botones">
      @guest
        <a href="{{ route('registro') }}" class="boton">Crear cuenta y reservar</a>
        <a href="{{ route('login') }}" class="boton boton-sec">Iniciar sesión</a>
      @else
        @if (auth()->user()->esCliente())
          <a href="{{ route('reservar') }}" class="boton">Reservar un lavado</a>
        @else
          <a href="{{ route('panel') }}" class="boton">Ir a mi panel</a>
        @endif
      @endguest
    </p>
  </section>

  <section class="tarjeta">
    <h2>Servicios y precios</h2>
    @include('publico._precios', ['editable' => false])
  </section>
@endsection