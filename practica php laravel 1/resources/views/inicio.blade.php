@extends('layouts.base')

@section('titulo', 'Inicio')

@section('contenido')
  <section class="tarjeta">
    <h1>Tu auto limpio, rápido y a buen precio</h1>
    <p>
      En Lavado de Autos Apaza cuidamos la limpieza y el aspecto de tu vehiculo.
      Atendemos a clientes particulares propietarios de vehículos de transporte
      y flotas pequeñas de la ciudad de Oruro
    </p>
  </section>

  <section class="tarjeta">
    <h2>Servicios y precios</h2>
    <table>
      <tr>
        <th>Servicio</th>
        <th>Precio</th>
      </tr>
      @foreach ($servicios as $servicio)
        <tr>
          <td>{{ $servicio['nombre'] }}</td>
          <td>{{ $servicio['precio'] }}</td>
        </tr>
      @endforeach
    </table>
  </section>
@endsection