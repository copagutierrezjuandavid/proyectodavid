@extends('layouts.base')

@section('titulo', 'Agregar servicio')

@section('contenido')
  <section class="tarjeta">
    <h1>Agregar un servicio</h1>

    @if ($errors->any())
      <div class="aviso error">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('servicios.guardar') }}" method="POST">
      @csrf

      <label for="nombre">Nombre del servicio</label>
      <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Lavado de tapizados">

      <label for="precio">Precio en Bs</label>
      <input type="number" id="precio" name="precio" value="{{ old('precio') }}" placeholder="Ej: 35">

      <button type="submit">Guardar servicio</button>
    </form>

    <p><a href="{{ route('panel') }}">&larr; Volver al panel</a></p>
  </section>
@endsection