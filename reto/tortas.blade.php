<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tortas - Pastelería La Espiga</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff8f0; margin: 0; padding: 2rem; }
        .caja { max-width: 700px; margin: auto; background: #fff; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h1 { margin-top: 0; color: #8a4b08; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: .7rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #8a4b08; color: #fff; }
        .boton { display: inline-block; margin-bottom: 1rem; padding: .6rem 1rem; background: #8a4b08; color: #fff; text-decoration: none; border-radius: 6px; }
        .sin-stock { color: #c0392b; font-weight: bold; }
    </style>
</head>
<body>
    <div class="caja">
        <h1>Tortas</h1>
        <a class="boton" href="/tortas/nuevo">+ Nueva torta</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sabor</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tortas as $torta)
                    <tr>
                        <td>{{ $torta->id }}</td>
                        <td>{{ $torta->sabor }}</td>
                        <td>{{ $torta->precio }}</td>
                        <td class="{{ $torta->stock == 0 ? 'sin-stock' : '' }}">{{ $torta->stock }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No hay tortas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>