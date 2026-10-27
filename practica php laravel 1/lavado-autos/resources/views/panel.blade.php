@extends('layouts.base')

@section('titulo', 'Panel')

@section('contenido')
  <section class="tarjeta">
    <h1>Hola, {{ auth()->user()->name }}</h1>
    <p>Entraste con <strong>{{ auth()->user()->email }}</strong>. Esta página no existe para quien no tenga la llave.</p>

    @if (session('exito'))
      <p class="aviso exito">{{ session('exito') }}</p>
    @endif

    <h2>Tus servicios ({{ count($servicios) }})</h2>
    <table>
      <tr><th>#</th><th>Servicio</th><th>Precio</th></tr>
      @foreach ($servicios as $s)
        <tr>
          <td>{{ $s->id }}</td>
          <td>{{ $s->nombre }}</td>
          <td>{{ $s->precio }} Bs</td>
        </tr>
      @endforeach
    </table>

    <p><a href="{{ route('servicios.nuevo') }}">+ Agregar un servicio</a></p>

    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit">Salir</button>
    </form>
  </section>
@endsection