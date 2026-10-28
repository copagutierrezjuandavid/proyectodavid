@extends('layouts.base')

@section('titulo', 'Usuarios')

@section('contenido')
  <section class="tarjeta">
    <h1>Personal del lavado</h1>
    <p><a href="{{ route('usuarios.crear') }}" class="boton">+ Nuevo usuario</a></p>
    <div class="tabla-scroll">
      <table>
        <tr><th>Nombre</th><th>Correo</th><th>Rol</th></tr>
        @foreach ($usuarios as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->rolEtiqueta() }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </section>
@endsection