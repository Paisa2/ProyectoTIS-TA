{{-- @extends('base')
@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
<div style="width:90%" class="container-table">
    <h1 class="display-4">Detalle de Rol: {{$registro->nombre_empresa}}</h1>
    <br>
      <div class="overflow-auto">
        <table class="table">
          <thead>
            <tr>
              <th>Nombre Comercial</th>
              <th>Representante Legal</th>
              <th>Rubro</th>
              <th>Telefono</th>
              <th>Correo Electronico</th>
              <th>Nit</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
  </div>
@endsection --}}

@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
<div style="width:50%" class="container-table">
    <h1 class="display-4">{{$registro->nombre_empresa}}</h1>
    <br>
    <div class="col-lg-12">
      <dl>
        <label><b><h4>Nombre Comercial:</h4></b></label>
        <label>{{$registro->acronimo_empresa}}</label> 
      </dl>
        
      <dl>
        <label><b><h4>Rubro:</h4></b></label>
        <label>{{$registro->rubro_empresa}}</label> 
      </dl>
        
      <dl>
        <label><b><h4>Representante Legal:</h4></b></label>
        <label>{{$registro->representante_legal}}</label>
      </dl>
        
      <dl>
        <label><b><h4>NIT:</h4></b></label>
        <label>{{$registro->nit_empresa}}</label>
      </dl>
        
      <dl>
        <label><b><h4>Dirección:</h4></b></label>
        <label>{{$registro->direccion_empresa}}</label>
      </dl>
        
      <dl>
        <label><b><h4>Telefono:</h4></b></label>
        <label>{{$registro->telefono_empresa}}</label>
      </dl>
        
      <dl>
        <label><b><h4>Correo Electronico:</h4></b></label>
        <label>{{$registro->email_empresa}}</label>
      </dl>
      </div>
</div>
@endsection
