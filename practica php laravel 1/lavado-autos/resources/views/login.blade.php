@extends('layouts.base')

@section('titulo', 'Entrar')

@section('contenido')
  <section class="tarjeta">
    <h1>Entrar al panel</h1>

    @if (session('error'))
      <p class="aviso error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.entrar') }}" method="POST">
      @csrf

      <label for="email">Correo</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Entrar</button>
    </form>
  </section>
@endsection