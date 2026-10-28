@extends('layouts.base')

@section('titulo', 'Clientes')

@section('contenido')
  <section class="tarjeta">
    <h1>Clientes</h1>

    <form action="{{ route('clientes.index') }}" method="GET" class="fila-form">
      <div>
        <label for="q">Buscar por nombre, teléfono o placa</label>
        <input type="text" id="q" name="q" value="{{ $q }}">
      </div>
      <div><button type="submit">Buscar</button></div>
    </form>

    <p><a href="{{ route('clientes.crear') }}" class="boton">+ Registrar cliente</a></p>

    <div class="tabla-scroll">
      <table>
        <tr><th>Nombre</th><th>Teléfono</th><th>Vehículos</th><th>Lavados</th><th>Categoría</th><th>Cuenta web</th><th></th></tr>
        @forelse ($clientes as $c)
          @php $cat = \App\Models\Cliente::categoria($c->visitas); @endphp
          <tr>
            <td>{{ $c->nombre }}</td>
            <td>{{ $c->telefono ?: '—' }}</td>
            <td>{{ $c->vehiculos_count }}</td>
            <td>{{ $c->visitas }}</td>
            <td><span class="insignia e-{{ strtolower($cat) }}">{{ $cat }}</span></td>
            <td>{{ $c->user_id ? 'Sí' : 'No' }}</td>
            <td><a href="{{ route('clientes.ver', $c) }}" class="btn-chico">Ver</a></td>
          </tr>
        @empty
          <tr><td colspan="7">No se encontraron clientes.</td></tr>
        @endforelse
      </table>
    </div>
  </section>
@endsection