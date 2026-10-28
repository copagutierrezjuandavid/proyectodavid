@extends('layouts.base')

@section('titulo', 'Crear cuenta')

@section('contenido')
  <section class="tarjeta tarjeta-angosta">
    <h1>Crear cuenta de cliente</h1>

    <form action="{{ route('registro.guardar') }}" method="POST">
      @csrf
      <label for="name">Nombre completo</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required>

      <label for="email">Correo</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required>

      <label for="telefono">Teléfono (7 u 8 dígitos)</label>
      <input type="text" inputmode="numeric" id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 61659011" required>

      <label for="password">Contraseña (mínimo 8 caracteres)</label>
      <input type="password" id="password" name="password" required>

      <label for="password_confirmation">Repite la contraseña</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required>

      <button type="submit">Crear cuenta</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
  </section>
@endsection