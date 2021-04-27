@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">


@endsection


@section('main')

<!-- codigo importante -->

<div class="container my-4 container-table" >

<h2>Usuarios Registrados</h2>

  <table class="table">

      <div style="display:flex;justify-content:flex-end;">
        <a class="btn btn-primary" href="{{url('usuario/create')}}">Nuevo</a>
      </div>
      <thead>
        <tr>
          <th scope="col">Número</th>
          <th scope="col">Nombres</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Rol</th>
          <th scope="col">Email</th>
          <th scope="col">Pertenece a</th>
          <th scope="col">Fecha creación</th>
        </tr>
      </thead>
      @foreach($usuarios as $usuario)
      <tbody>
        <tr>
          <td>{{ $loop->index +1 }}</td>
          <td>{{$usuario->nombres}}</td>
          <td>{{$usuario->apellidos}}</td>
          <td>{{$usuario->nombre_rol}}</td>
          <td>{{$usuario->email}}</td>
          <td>{{$usuario->nombre_unidad}}</td>
          <td>{{$usuario->created_at}}</td>
        </tr>
      </tbody>
      @endforeach


  </table>

</div>

<!-- fin codigo importante -->
@endsection