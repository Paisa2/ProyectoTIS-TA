@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')

@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
  {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",4000);</script>
@endif
@if(session()->has('success'))
    <div class="alert alert-success" role="alert" id="success">
        {{ session()->get('success') }}
    </div>
    <script>setTimeout("document.getElementById('success').classList.add('d-none');",3000);</script>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger" role="alert" id="error">
        {{ session()->get('error') }}
    </div>
    <script>setTimeout("document.getElementById('error').classList.add('d-none');",3000);</script>
@endif
<div style="width:90%; margin:24px auto;" class="container-table">

  <h1 class="display-4">Items de Gasto Registrados</h1>
  @if(session()->has('Crear item de gasto'))
  <div style="display:flex;justify-content:flex-end;" class="mb-3">
    <a class="btn btn-primary" href="{{url('itemsgastos/create')}}" role="button">+ Nuevo</a>
  </div>
  @else
  <br><br>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col" class="options">NRO</th>
        <th scope="col">TIPO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">PERTENECE A</th>
        <th scope="col">DETALLE DE CREACIÓN</th>
        @if(session('Eliminar item de gasto'))
        <th class="options"></th>
        @endif 
      </tr>
    </thead>
    <tbody>
    @foreach($itemsgastos as $itemgasto)
      <tr>
        <td scope="row">{{ $loop->index +1}}</td>
        <td>{{$itemgasto->tipo_item}}</td>
        <td>{{$itemgasto->nombre_item}}</td>
        <td>{{$itemgasto->pertenece_a}}</td>
        <td>{{date("Y-m-d",strtotime($itemgasto->created_at))}}</td>
        <td class="options">
          @if($itemgasto->especificos == 0 && session('Eliminar item de gasto'))
          <div class="dropdown dropleft">
            <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="c-icon mfe-2">
                <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
              </svg>
            </span>
            <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
              <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
              <form action="{{ route('itemsgastos.destroy', $itemgasto->id) }}" method="post" class="d-none" id="delete{{$loop->index +1}}">{{ csrf_field() }}{{ method_field('delete') }}</form>
              <button class="dropdown-item" type="submit" form="delete{{$loop->index +1}}">
                <svg class="c-icon mfe-2">
                  <use xlink:href="{{asset('img/icons/trash.svg#i-trash')}}"></use>
                </svg>Eliminar
              </button>
            </div>
          </div>
          @endif 
        </td>
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
