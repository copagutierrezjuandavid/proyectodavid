@extends('layouts.base')

@section('titulo', 'Servicios')

@section('contenido')
  <section class="tarjeta">
    <h1>Nuestros servicios</h1>
    @php $editable = auth()->check() && auth()->user()->esGerente(); @endphp
    @include('publico._precios', ['editable' => $editable])
    @if ($editable)
      <p><a href="{{ route('servicios.nuevo') }}" class="boton">+ Agregar servicio</a></p>
    @endif
  </section>
@endsection