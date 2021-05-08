@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
@if(session()->has('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
{{session()->get('confirm')}}
</div>
@endif
<div style="width:90%; margin:24px auto;" class="container-table">

  <h1 class="display-4">Items de Gasto Registrados</h1>
  <div style="display:flex;justify-content:flex-end;" class="mb-3">
    <a class="btn btn-primary" href="{{url('itemsgastos/create')}}" role="button">+ Nuevo</a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">NRO</th>
        <th scope="col">TIPO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">PERTENECE A</th>
        <th scope="col">DETALLE DE CREACIÓN</th>
      </tr>
    </thead>
    <tbody>
    @foreach($itemsgastos as $itemgasto)
      <tr>
        <td scope="row">{{ $loop->index +1}}</td>
        <td>{{$itemgasto->tipo_item}}</td>
        <td>{{$itemgasto->nombre_item}}</td>
        <td>{{$itemgasto->pertenece_a}}</td>
        <td>{{$itemgasto->created_at}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection
