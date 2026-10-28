@extends('layouts.espiga')

@section('contenido')
  <h2>Registrar una torta</h2>

  @if ($errors->any())
    <div class="errores">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="/tortas/nuevo" method="POST" novalidate>
    @csrf

    <label for="sabor">Sabor de la torta</label>
    <input type="text" id="sabor" name="sabor" value="{{ old('sabor') }}">

    <label for="precio">Precio en Bs</label>
    <input type="number" id="precio" name="precio" value="{{ old('precio') }}">

    <button type="submit">Registrar torta</button>
  </form>

  <p><a href="/tortas">&larr; Volver a la lista</a></p>
@endsection