@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')

<div style="width:70%" class="container-table">
  <h1 class="display-4">Detalle de Solicitud</h1>
  <br>
  <div class="mb-3 font-large">
    <div class="row">
      <div class="col-6">
        <label><b>De:</b></label>
        <label>{{$solicitud->nombres}} {{$solicitud->apellidos}}</label>
      </div>
      <div class="col-6">
        <label><b>Para:</b></label>
        <label>{{$solicitud->nombres_dest}} {{$solicitud->apellidos_dest}}</label>
      </div>
    </div>
  </div>
  <div class="mb-3 font-large">
    <label><b>Solicitud:</b></label>
    <div style="width:100%; height:13.5rem; border-radius: 5px; border:1px solid #fff; padding:10px;">
      {{$solicitud->detalle_solicitud_item}}
    </div>
  </div>

</div>

@endsection