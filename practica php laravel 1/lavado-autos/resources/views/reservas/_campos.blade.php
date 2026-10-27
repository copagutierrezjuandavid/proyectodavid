<label for="servicio_id">Servicio</label>
<select id="servicio_id" name="servicio_id" required>
  <option value="">— Elige un servicio —</option>
  @foreach ($servicios as $s)
    <option value="{{ $s->id }}" @selected(old('servicio_id') == $s->id)>{{ $s->nombre }}</option>
  @endforeach
</select>

<div class="fila-form">
  <div>
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" min="{{ today()->toDateString() }}"
           value="{{ old('fecha', today()->toDateString()) }}" required>
  </div>
  <div>
    <label for="hora">Hora</label>
    <select id="hora" name="hora" required>
      @foreach ($horarios as $h)
        <option value="{{ $h }}" @selected(old('hora') === $h)>{{ $h }}</option>
      @endforeach
    </select>
  </div>
</div>

<label for="comentario">Comentario (opcional)</label>
<textarea id="comentario" name="comentario" rows="3"
          placeholder="Ej: tapizado muy sucio, también quiero encerado">{{ old('comentario') }}</textarea>