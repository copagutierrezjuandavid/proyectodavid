@extends('layouts.base')

@section('titulo', 'Editar servicio')

@section('contenido')
  <section class="tarjeta">
    <h1>Editar servicio</h1>
    <form action="{{ route('servicios.actualizar', $servicio) }}" method="POST">
      @method('PUT')
      @include('servicios._form')
      <button type="submit">Guardar cambios</button>
    </form>
    <p><a href="{{ route('servicios') }}">&larr; Volver a servicios</a></p>
  </section>
@endsection