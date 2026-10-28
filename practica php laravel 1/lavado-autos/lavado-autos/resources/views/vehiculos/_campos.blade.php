<div class="fila-form">
  <div>
    <label for="placa">Placa</label>
    <input type="text" id="placa" name="placa" value="{{ old('placa') }}" placeholder="Ej: 1234ABC" maxlength="10" required>
  </div>
  <div>
    <label for="tipo">Tipo de vehículo</label>
    <select id="tipo" name="tipo" required>
      @foreach (\App\Models\Vehiculo::TIPOS as $valor => $etiqueta)
        <option value="{{ $valor }}" @selected(old('tipo') === $valor)>{{ $etiqueta }}</option>
      @endforeach
    </select>
  </div>
  <div>
    <label for="marca">Marca / modelo (opcional)</label>
    <input type="text" id="marca" name="marca" value="{{ old('marca') }}" placeholder="Ej: Toyota Hilux">
  </div>
</div>