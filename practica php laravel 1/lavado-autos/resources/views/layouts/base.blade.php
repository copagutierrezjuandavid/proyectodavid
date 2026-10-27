<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('titulo') - Lavado de Autos Apaza</title>
  <script>
    try {
      var guardado = localStorage.getItem('tema-apaza');
      if (guardado === 'oscuro' || (!guardado && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.setAttribute('data-tema', 'oscuro');
      }
    } catch (e) {}
  </script>
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
        @auth
          @if (auth()->user()->esCliente())
            <li><a href="{{ route('reservar') }}">Reservar</a></li>
          @else
            <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li><a href="{{ route('reservas.index') }}">Reservas</a></li>
            @if (auth()->user()->esGerente())
              <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
            @endif
          @endif
        @endauth
      </ul>
    </nav>
    <div class="acciones">
      <button type="button" id="boton-tema" class="boton-tema">🌙 Oscuro</button>
      @auth
        <a href="{{ route('panel') }}" class="usuario">
          <span class="avatar">👤</span>
          <span class="usuario-datos">
            <strong>{{ auth()->user()->name }}</strong>
            <small>{{ auth()->user()->rolEtiqueta() }}</small>
          </span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="form-inline">
          @csrf
          <button type="submit" class="boton-tema">Salir</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn-link">Iniciar sesión</a>
        <a href="{{ route('registro') }}" class="btn-link">Registrarse</a>
      @endauth
    </div>
  </header>

  <main>
    @if (session('exito'))
      <p class="aviso exito">{{ session('exito') }}</p>
    @endif
    @if (session('error'))
      <p class="aviso error">{{ session('error') }}</p>
    @endif
    @if ($errors->any())
      <div class="aviso error">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    @yield('contenido')
  </main>

  <footer>
    <p>Lavado de Autos Apaza - Av. America esquina Arica, Oruro, Bolivia</p>
    <p>Desarrollado por: Juan David Copa Gutierrez - hecho con Laravel</p>
  </footer>

  <script>
    (function () {
      var raiz = document.documentElement;
      var boton = document.getElementById('boton-tema');
      function pintar() {
        boton.textContent = raiz.getAttribute('data-tema') === 'oscuro' ? '☀️ Claro' : '🌙 Oscuro';
      }
      pintar();
      boton.addEventListener('click', function () {
        var oscuro = raiz.getAttribute('data-tema') === 'oscuro';
        if (oscuro) { raiz.removeAttribute('data-tema'); } else { raiz.setAttribute('data-tema', 'oscuro'); }
        try { localStorage.setItem('tema-apaza', oscuro ? 'claro' : 'oscuro'); } catch (e) {}
        pintar();
      });
    })();
  </script>
</body>
</html>