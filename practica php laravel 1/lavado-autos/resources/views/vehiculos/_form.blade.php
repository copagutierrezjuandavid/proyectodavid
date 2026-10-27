<form action="{{ $action }}" method="POST">
  @csrf
  @include('vehiculos._campos')
  <button type="submit">Guardar vehículo</button>
</form>