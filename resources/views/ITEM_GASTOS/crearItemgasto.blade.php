@extends('base')

@section('title')
Crear item
@endsection

@section('head')
<title>Items de Gasto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('main')
<div class="container my-4">

<form method="post" action="{{ route('itemsgastos') }}">
  {{csrf_field()}}
  <h1 class="display-4">Registro de item de gasto</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tipo:</label>
    <br>
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <!--{{ (old('tipo_item') == "Generico") ? "checked" : ""}}-->
    <input type="radio" class="btn-check" name="tipo_item" id="btnradio1" autocomplete="off" value="Generico" checked="">
    <label class="btn btn-outline-primary" for="btnradio1">Generico</label>
    <!--{{ (old('tipo_item') == "Especifico") ? "checked" : ""}}-->
    <input type="radio" class="btn-check" name="tipo_item" id="btnradio2" autocomplete="off" value="Especifico">
    <label class="btn btn-outline-primary" for="btnradio2">Especifico</label>
    </div>
    @foreach($errors->get('tipo_item') as $message)
    <div class="alert alert-danger">{{$message}}</div>
    @endforeach
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nombre:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="nombre_item" value="{{ old('nombre_item') }}" autocomplete="off">
    <div class="br"> </div>
    @foreach($errors->get('nombre_item') as $message)
    <div class="alert alert-danger">{{$message}}</div>
    @endforeach
  </div>
  
  <div class="mb-3">
      <label for="disabledSelect" class="form-label">Pertenece a:</label>
      <select class="form-control" name="item_id" id="item_id" disabled>
      <option hidden selected>Seleccione</option>
      @foreach($items as $item)
      <option value="{{$item->id}}">{{$item->nombre_item}}</option>
      @endforeach
      </select>
      @foreach($errors->get('item_id') as $message)
      <div class="alert alert-danger">{{$message}}</div>
      @endforeach
  </div>
  <div style=display:flex;justify-content:center;>
    <button type="submit" class="btn btn-primary">REGISTRAR</button>
  </div>
</form>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
    $('input[name="tipo_item"]').on('change',function()
    {
      $('select[name="item_id"]').attr('disabled',this.value!="Especifico")
    });
    </script>
@endsection