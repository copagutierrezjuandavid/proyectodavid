<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo') - Lavado de Autos Apaza</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  <header>
    <p class="marca">Lavado de Autos Apaza</p>
    <nav>
      <ul>
        <li><a href="{{ route('inicio') }}">Inicio</a></li>
        <li><a href="{{ route('servicios') }}">Servicios</a></li>
        <li><a href="{{ route('contacto') }}">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <main>
    @yield('contenido')
  </main>

  <footer>
    <p>Lavado de Autos Apaza - Av. America esquina Arica, Oruro, Bolivia</p>
    <p>Desarrollado por: Juan David Copa Gutierrez - hecho con Laravel</p>
  </footer>
</body>
</html>