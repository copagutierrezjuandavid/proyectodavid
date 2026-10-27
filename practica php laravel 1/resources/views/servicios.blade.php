@extends('layouts.base')

@section('titulo', 'Servicios')

@section('contenido')

  {{-- ===== FORMULARIO: UN SOLO BOTÓN ===== --}}
  <section class="tarjeta">
    <h1>Agregar un servicio</h1>

    @if (session('exito'))
      <p class="aviso exito">{{ session('exito') }}</p>
    @endif

    @if ($errors->any())
      <div class="aviso error">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('servicios.guardar') }}" method="POST">
      @csrf

      <label for="nombre_servicio">Nombre del servicio</label>
      <input type="text" id="nombre_servicio" name="nombre_servicio" value="{{ old('nombre_servicio') }}" placeholder="Ej: Lavado de tapizados">

      <label for="precio">Precio en Bs</label>
      <input type="number" id="precio" name="precio" value="{{ old('precio') }}" placeholder="Ej: 35">

      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Tu nombre y apellido">

      <label for="correo">Correo electrónico</label>
      <input type="text" id="correo" name="correo" value="{{ old('correo') }}" placeholder="tunombre@gmail.com">

      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 61659011">

      <label for="mensaje">Mensaje</label>
      <textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos qué necesitas">{{ old('mensaje') }}</textarea>

      <button type="submit">Guardar</button>
    </form>
  </section>

  {{-- ===== LISTA COMPLETA (viene de la base de datos) ===== --}}
  <section class="tarjeta">
    <h2>Servicios guardados</h2>
    <p>Esta lista viene de la base de datos. Si recargas siguen ahí.</p>

    <div style="overflow-x: auto;">
      <table>
        <tr>
          <th>#</th>
          <th>Servicio</th>
          <th>Precio (Bs)</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Mensaje</th>
        </tr>
        @forelse ($registros as $r)
          <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->servicio }}</td>
            <td>{{ $r->precio }} Bs</td>
            <td>{{ $r->nombre }}</td>
            <td>{{ $r->correo }}</td>
            <td>{{ $r->telefono }}</td>
            <td>{{ $r->mensaje }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7">Todavía no hay servicios guardados.</td>
          </tr>
        @endforelse
      </table>
    </div>
  </section>
@endsection