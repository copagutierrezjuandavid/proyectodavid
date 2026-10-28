@extends('layouts.base')

@section('titulo', 'Nuevo usuario')

@section('contenido')
  <section class="tarjeta tarjeta-angosta">
    <h1>Nuevo usuario del personal</h1>

    <form action="{{ route('usuarios.guardar') }}" method="POST">
      @csrf
      <label for="name">Nombre completo</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required>

      <label for="email">Correo</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required>

      <label for="role">Rol</label>
      <select id="role" name="role" required>
        <option value="cajero" @selected(old('role') === 'cajero')>Cajero</option>
        <option value="gerente" @selected(old('role') === 'gerente')>Gerente</option>
      </select>

      <label for="password">Contraseña (mínimo 8 caracteres)</label>
      <input type="password" id="password" name="password" required>

      <label for="password_confirmation">Repite la contraseña</label>
      <input type="password" id="password_confirmation" name="password_confirmation" required>

      <button type="submit">Crear usuario</button>
    </form>
  </section>
@endsection