<div class="tabla-scroll">
  <table>
    <tr>
      <th>Servicio</th>
      @foreach (\App\Models\Vehiculo::TIPOS as $etiqueta)
        <th>{{ $etiqueta }}</th>
      @endforeach
      @if ($editable)<th></th>@endif
    </tr>
    @forelse ($servicios as $s)
      <tr>
        <td>{{ $s->nombre }}</td>
        @foreach (\App\Models\Vehiculo::TIPOS as $tipo => $etiqueta)
          <td>{{ $s->precioPara($tipo) }} Bs</td>
        @endforeach
        @if ($editable)
          <td><a href="{{ route('servicios.editar', $s) }}">Editar</a></td>
        @endif
      </tr>
    @empty
      <tr><td colspan="6">Pronto publicaremos nuestros servicios.</td></tr>
    @endforelse
  </table>
</div>
<p class="ayuda">El precio final puede variar según el estado del vehículo.</p>