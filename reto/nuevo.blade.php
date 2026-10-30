<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva torta - Pastelería La Espiga</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff8f0; margin: 0; padding: 2rem; }
        .caja { max-width: 420px; margin: auto; background: #fff; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h1 { margin-top: 0; color: #8a4b08; }
        label { display: block; margin: 1rem 0 .3rem; font-weight: bold; }
        input { width: 100%; padding: .6rem; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
        input.invalido { border-color: #c0392b; }
        .error { color: #c0392b; font-size: .9rem; margin-top: .3rem; }
        button { margin-top: 1.5rem; width: 100%; padding: .7rem; background: #8a4b08; color: #fff; border: 0; border-radius: 6px; font-size: 1rem; cursor: pointer; }
        a { display: inline-block; margin-top: 1rem; color: #8a4b08; }
    </style>
</head>
<body>
    <div class="caja">
        <h1>Nueva torta</h1>

        <form method="POST" action="/tortas/nuevo" novalidate>
            @csrf

            <label for="sabor">Sabor</label>
            <input type="text" id="sabor" name="sabor" value="{{ old('sabor') }}"
                   class="{{ $errors->has('sabor') ? 'invalido' : '' }}">
            @error('sabor') <div class="error">{{ $message }}</div> @enderror

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" value="{{ old('precio') }}"
                   class="{{ $errors->has('precio') ? 'invalido' : '' }}">
            @error('precio') <div class="error">{{ $message }}</div> @enderror

            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" step="1"
                   class="{{ $errors->has('stock') ? 'invalido' : '' }}">
            @error('stock') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Guardar torta</button>
        </form>

        <a href="/tortas">← Volver a la lista</a>
    </div>
</body>
</html>