@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
<!-- codigo importante -->
<div style="width:90%; margin:24px auto;" class="container-table">
  <h1>Solicitudes de registro de items</h1>
  <div style="display:flex;justify-content:flex-end;">
    <a href="{{url('solicitudes-de-items/create')}}" class="btn btn-primary">+Nuevo</a>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Nro</th>
        <th scope="col">De</th>
        <th scope="col">Para</th>
        <th scope="col">Detalle</th>
        <th scope="col">Fecha creacion</th>
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