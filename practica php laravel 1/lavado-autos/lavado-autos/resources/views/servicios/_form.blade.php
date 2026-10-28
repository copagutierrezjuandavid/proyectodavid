@csrf
<label for="nombre">Nombre del servicio</label>
<input type="text" id="nombre" name="nombre" value="{{ old('nombre', $servicio->nombre ?? '') }}" placeholder="Ej: Lavado completo" required>

<div class="fila-form">
  <div>
    <label for="precio">Auto particular (Bs)</label>
    <input type="number" id="precio" name="precio" min="1" value="{{ old('precio', $servicio->precio ?? '') }}" required>
  </div>
  <div>
    <label for="precio_camioneta">Camioneta (Bs)</label>
    <input type="number" id="precio_camioneta" name="precio_camioneta" min="1" value="{{ old('precio_camioneta', $servicio->precio_camioneta ?? '') }}">
  </div>
  <div>
    <label for="precio_minibus">Minibús (Bs)</label>
    <input type="number" id="precio_minibus" name="precio_minibus" min="1" value="{{ old('precio_minibus', $servicio->precio_minibus ?? '') }}">
  </div>
  <div>
    <label for="precio_bus">Bus (Bs)</label>
    <input type="number" id="precio_bus" name="precio_bus" min="1" value="{{ old('precio_bus', $servicio->precio_bus ?? '') }}">
  </div>
</div>
<p class="ayuda">Si dejas vacío camioneta, minibús o bus, se usa el precio de auto particular.</p>