@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">


@endsection

@section('main')

<!-- codigo importante -->

@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
      {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div class="container my-4 container-table" >
    <div class='d-flex justify-content-center'>
        <h1 class="display-4">Usuarios Registrados</h1>
    </div>
    <table class="table">

        @if(session()->has('Crear usuario'))
        <div style="display:flex;justify-content:flex-end;" class="mb-3">
            <a class="btn btn-primary" href="{{url('usuario/create')}}">+ Nuevo</a>
        </div>
        @else
        <br><br>
        @endif
          <thead>
              <tr>
                  <th scope="col">NRO</th>
                  <th scope="col">NOMBRES</th>
                  <th scope="col">APELLIDOS</th>
                  <th scope="col">ROL</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">PERTENECE A</th>
                  <th scope="col">FECHA DE CREACIÓN</th>
              </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)

                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{$usuario->nombres}}</td>
                        <td>{{$usuario->apellidos}}</td>
                        <td>{{$usuario->nombre_rol}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->nombre_unidad}}</td>
                        <td>{{$usuario->created_at}}</td>
                    </tr>
            @endforeach
          </tbody>


    </table>

</div>

<!-- fin codigo importante -->
@endsection