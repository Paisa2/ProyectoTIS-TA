@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
<!-- codigo importante -->
@if(session()->has('confirm'))
    <div class="alert alert-success" role="alert" id="confirm">
        {{ session()->get('confirm') }}
    </div>
    <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div style="width:90%; margin:24px auto;" class="container-table">
  <h1 class="display-4">Solicitudes de registro de items</h1>
  <div style="display:flex;justify-content:flex-end;" class="mb-3">
    <a href="{{url('solicitudes-de-items/create')}}" class="btn btn-primary">+Nuevo</a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">NRO</th>
        <th scope="col">DE</th>
        <th scope="col">PARA</th>
        <th scope="col">DETALLE</th>
        <th scope="col">FECHA DE CREACIÓN</th>
      </tr>
    </thead>
    <tbody>
    @foreach($solicitudes as $solicitud)
      <tr>
        <th scope="row">{{$loop->index +1}}</th>
        <td>{{$solicitud->nombres_de}}</td>
        <td>{{$solicitud->nombres_para}}</td>
        <td>{{$solicitud->detalle_solicitud_item}}</td>
        <td>{{$solicitud->created_at}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

</div>
<!-- fin codigo importante -->
  
@endsection