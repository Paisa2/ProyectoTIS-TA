@extends('base')
@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
<div style="width: 90%; margin:24px auto;" class="container-table">
    <h1>Adquisiciones Registradas</h1>
    <div class="row g-2">
      <div class="col-md">
      <form action="" method="get">
      {{-- <div class="btn-group" role="group" aria-label="Basic outlined example">
        <input type="submit" value="compra" class="btn btn-outline-primary" name="compra" id="compra">
        <input type="submit" value="alquiler" class="btn btn-outline-primary" name="alquiler" id="alquiler">
      </div> --}}
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="submit" class="btn btn-primary" name="todos" id="todos" value="todos" checked>
      
        <input type="submit" class="btn btn-primary" name="compra" id="compra" value="compra">
      
        <input type="submit" class="btn btn-primery" name="alquiler" id="compra" value="alquiler" >
      </div>
      </form>
      </div>
      <div class="col-md">
      <div class="d-flex justify-content-end mb-3">
        <a href="{{route('solicitud.create')}}" class="btn btn-primary">+ Nuevo</a>
      </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NRO</th>
                <th scope="col">JUSTIFICACION</th>
                <th scope="col">FECHA</th>
                <th scope="col">TIPO</th>
                <th scope="col">ESTADO</th>
            </tr>
        </thead>
        <tbody>
        @foreach($solicitudes as $listadb)
        <tr>
            <td scope="row">{{ $loop->index +1}}</td>
            <td>{{$listadb->justificacion_solicitud_a}}</td>
            <td>{{$listadb->fecha_entrega}}</td>
            <td>{{$listadb->tipo_solicitud_a}}</td>
            <td>{{$listadb->estado_solicitud_a}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{--  {!!$unidad->render()!!}  --}}
    </div>
@endsection