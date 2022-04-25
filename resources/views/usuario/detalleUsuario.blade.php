@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection


@section('main')
<div style="width:50%" class="container-table">
    <h1 class="display-4">Detalle de Usuario</h1>
    <br>
    <div>
        <label><b><h4>Nombres:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->nombres}}</label><br>
        
        <label><b><h4>Apellidos:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->apellidos}}</label><br>

        <label><b><h4>Ci:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->ci_usuario}}</label><br>

        <label><b><h4>Teléfono:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->telefono_usuario}}</label><br>

        <label><b><h4>Rol:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->nombre_rol}}</label><br>

        <label><b><h4>Pertenece a:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->nombre_unidad}}</label><br>

        <label><b><h4>Email:</h4></b></label>
        <label style="font-size: 1.2rem;">{{$usuario->email}}</label><br>
      </div>
</div>
@endsection
