@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
    <div class="container-table">
        <h1>Detalle Usuario</h1>
        <label>
            <b>Nombres:</b>
             {{$usuario->nombres}}            
        </label>
        <br></br>
        <label>
            <b>Apellidos:</b>
             {{$usuario->apellidos}}            
        </label>
        <br></br>
        <label>
            <b>Ci: </b>
            {{$usuario->ci_usuario}}            
        </label>
        <br></br>
        <label>
            <b>Teléfonos:</b>
             {{$usuario->telefono_usuario}}            
        </label>
        <br></br>
        <label>
            <b>Rol:</b>
             {{$usuario->nombre_rol}}            
        </label>
        <br></br>
        <label>
            <b>Pertenece a:</b>
             {{$usuario->nombre_unidad}}            
        </label>
        <br></br>
        <label>
            <b>Email:</b>
             {{$usuario->email}}            
        </label>
        <br></br>
    </div>
@endsection