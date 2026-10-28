@extends('layouts.espiga')

@section('contenido')
  <h2>Nuestras tortas</h2>
  <p>
    En Pastelería La Espiga horneamos cada día tortas artesanales con ingredientes frescos.
    Elige tu sabor favorito y endulza tu celebración.
  </p>

  <p><strong>Hay {{ $tortas->count() }} tortas en la vitrina.</strong></p>

  <ul>
    @foreach ($tortas as $torta)
      <li>{{ $torta->sabor }} - {{ $torta->precio }} Bs</li>
    @endforeach
  </ul>

  <p><a href="/tortas/nuevo" class="boton">Registrar otra torta</a></p>

  <p>Vitrina atendida por Juan David Copa Gutierrez</p>
@endsection