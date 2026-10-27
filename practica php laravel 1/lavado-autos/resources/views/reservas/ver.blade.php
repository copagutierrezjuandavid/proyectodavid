@extends('layouts.base')

@section('titulo', 'Reserva #' . $reserva->id)

@section('contenido')
  <section class="tarjeta">
    <h1>Reserva #{{ $reserva->id }}
      <span class="insignia e-{{ $reserva->estado }}">{{ $reserva->estadoEtiqueta() }}</span>
    </h1>

    <p><strong>Cliente:</strong> <a href="{{ route('clientes.ver', $reserva->cliente_id) }}">{{ $reserva->cliente->nombre }}</a>
       · Tel: {{ $reserva->cliente->telefono ?: '—' }}</p>
    <p><strong>Vehículo:</strong> {{ $reserva->vehiculo->placa }} — {{ $reserva->vehiculo->tipoEtiqueta() }}
       {{ $reserva->vehiculo->marca ? '· ' . $reserva->vehiculo->marca : '' }}</p>
    <p><strong>Servicio:</strong> {{ $reserva->servicio->nombre }}
       (tarifa base: {{ $reserva->servicio->precioPara($reserva->vehiculo->tipo) }} Bs)</p>
    <p><strong>Fecha y hora:</strong> {{ $reserva->fecha->format('d/m/Y') }} a las {{ $reserva->hora }}</p>
    <p><strong>Pedido por:</strong> {{ $reserva->origen === 'web' ? 'El cliente desde la web' : 'En el local' }}</p>
    <p><strong>Comentario del cliente:</strong> {{ $reserva->comentario ?: '—' }}</p>
    @if ($reserva->atendidoPor)
      <p><strong>Última atención de:</strong> {{ $reserva->atendidoPor->name }}</p>
    @endif
  </section>

  <section class="tarjeta">
    <h2>Gestionar reserva</h2>

    <form action="{{ route('reservas.actualizar', $reserva) }}" method="POST">
      @csrf
      @method('PUT')

      <label for="estado">Estado</label>
      <select id="estado" name="estado" required>
        @foreach (\App\Models\Reserva::ESTADOS as $valor => $etiqueta)
          <option value="{{ $valor }}" @selected(old('estado', $reserva->estado) === $valor)>{{ $etiqueta }}</option>
        @endforeach
      </select>

      <label for="precio">Precio final (Bs)</label>
      <input type="number" id="precio" name="precio" min="0" max="1000" value="{{ old('precio', $reserva->precio) }}" required>
      <p class="ayuda">Ajústalo si el vehículo llegó más sucio de lo normal (ej: 15, 20, 25, 35, 40, 50).</p>

      <label for="observacion">Comentario final (opcional)</label>
      <textarea id="observacion" name="observacion" rows="3"
                placeholder="Ej: quedó muy bien. Sugerimos encerado la próxima vez.">{{ old('observacion', $reserva->observacion) }}</textarea>

      <button type="submit">Guardar cambios</button>
    </form>

    <p><a href="{{ route('reservas.index') }}">&larr; Volver a reservas</a></p>
  </section>
@endsection