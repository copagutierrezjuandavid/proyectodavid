<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pastelería La Espiga</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 720px; margin: 0 auto; padding: 1rem; color: #222; }
    header, footer { text-align: center; padding: 1rem 0; }
    header { border-bottom: 2px solid #c98a4b; }
    footer { border-top: 1px solid #ccc; margin-top: 2rem; font-size: .9rem; color: #555; }
    h1 { color: #8a4b12; margin: 0; }
    label { display: block; margin-top: 1rem; font-weight: bold; }
    input { padding: .5rem; width: 100%; box-sizing: border-box; }
    button, .boton { display: inline-block; margin-top: 1rem; padding: .6rem 1.2rem; background: #8a4b12; color: #fff; border: 0; border-radius: 4px; text-decoration: none; cursor: pointer; }
    .errores { background: #fde8e8; border: 1px solid #e07a7a; color: #8a1f1f; padding: .5rem 1rem; margin-top: 1rem; border-radius: 4px; }
    li { margin: .4rem 0; }
  </style>
</head>
<body>
  <header>
    <h1>Pastelería La Espiga</h1>
  </header>

  <main>
    @yield('contenido')
  </main>

  <footer>
    <p>Integradora - Juan David Copa Gutierrez - 27 de octubre de 2026</p>
  </footer>
</body>
</html>