@extends('layouts.base')

@section('titulo', 'Servicios')

@section('contenido')
  <section class="tarjeta">
    <h1>Nuestros servicios</h1>
    <table>
      <tr><th>Servicio</th><th>Precio</th></tr>
      @forelse ($servicios as $s)
        <tr><td>{{ $s->nombre }}</td><td>{{ $s->precio }} Bs</td></tr>
      @empty
        <tr><td colspan="2">Pronto publicaremos nuestros servicios.</td></tr>
      @endforelse
    </table>
  </section>
@endsection