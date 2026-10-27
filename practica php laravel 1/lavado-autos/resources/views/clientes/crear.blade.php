@extends('layouts.base')

@section('titulo', 'Registrar cliente')

@section('contenido')
  <section class="tarjeta">
    <h1>Registrar cliente y vehículo</h1>

    <form action="{{ route('clientes.guardar') }}" method="POST">
      @csrf
      <h2>Datos del dueño</h2>
      <div class="fila-form">
        <div>
          <label for="nombre">Nombre completo</label>
          <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>
        <div>
          <label for="telefono">Teléfono (opcional, 7 u 8 dígitos)</label>
          <input type="text" inputmode="numeric" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>
      </div>

      <h2>Vehículo</h2>
      @include('vehiculos._campos')

      <button type="submit">Guardar cliente</button>
    </form>

    <p><a href="{{ route('clientes.index') }}">&larr; Volver a clientes</a></p>
  </section>
@endsection