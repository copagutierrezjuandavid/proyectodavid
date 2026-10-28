<div class="tabla-scroll">
  <table>
    <tr><th>Fecha</th><th>Hora</th><th>Cliente</th><th>Vehículo</th><th>Servicio</th><th>Bs</th><th>Estado</th><th></th></tr>
    @forelse ($reservas as $r)
      <tr>
        <td>{{ $r->fecha->format('d/m/Y') }}</td>
        <td>{{ $r->hora }}</td>
        <td><a href="{{ route('clientes.ver', $r->cliente_id) }}">{{ $r->cliente->nombre }}</a></td>
        <td><strong>{{ $r->vehiculo->placa }}</strong><br><small>{{ $r->vehiculo->tipoEtiqueta() }}</small></td>
        <td>{{ $r->servicio->nombre }}</td>
        <td>{{ $r->precio }}</td>
        <td><span class="insignia e-{{ $r->estado }}">{{ $r->estadoEtiqueta() }}</span></td>
        <td><a href="{{ route('reservas.ver', $r) }}" class="btn-chico">Gestionar</a></td>
      </tr>
    @empty
      <tr><td colspan="8">No hay reservas.</td></tr>
    @endforelse
  </table>
</div>