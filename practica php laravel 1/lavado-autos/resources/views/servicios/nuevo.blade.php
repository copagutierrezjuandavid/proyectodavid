@extends('layouts.base')

@section('titulo', 'Agregar servicio')

@section('contenido')
  <section class="tarjeta">
    <h1>Agregar un servicio</h1>
    <form action="{{ route('servicios.guardar') }}" method="POST">
      @include('servicios._form')
      <button type="submit">Guardar servicio</button>
    </form>
    <p><a href="{{ route('servicios') }}">&larr; Volver a servicios</a></p>
  </section>
@endsection