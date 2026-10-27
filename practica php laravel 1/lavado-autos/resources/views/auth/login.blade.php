@extends('layouts.base')

@section('titulo', 'Iniciar sesión')

@section('contenido')
  <section class="tarjeta tarjeta-angosta">
    <h1>Iniciar sesión</h1>
    <p>Entra como gerente, cajero o cliente.</p>

    <form action="{{ route('login.entrar') }}" method="POST">
      @csrf
      <label for="email">Correo</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Entrar</button>
    </form>

    <p>¿Eres cliente nuevo? <a href="{{ route('registro') }}">Crea tu cuenta</a></p>
  </section>
@endsection