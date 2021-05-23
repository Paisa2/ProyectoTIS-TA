@extends('base')

@section('title')
Subir PDF
@endsection

@section('head')
<title>Items de Gasto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('main')
<div class="container my-4">
    @if(session()->has('confirm'))
      <div class="alert alert-success" role="alert" id="confirm">
      {{session()->get('confirm')}}
      </div>
    @endif
  <form method="POST" action="{{ route('formulario') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <h1 class="display-4">Agregar Documento PDF</h1>
        
      <div class="mb-3">  
      <label for="disabledSelect" class="form-label">ID de la Cotización:</label>
      <!--<select class="form-control" name="cotizacion_id" id="cotizacion_id">
        <option hidden selected>Seleccione</option>
        @foreach($cotizaciones as $cotizacion)
        <option value="{{$cotizacion->id}}">{{$cotizacion->razon_social}}</option>
        @endforeach
      </select>-->
      @foreach($cotizaciones as $cotizacion)
      <input type="text" class="form-control" id="cotizacion_id" name="cotizacion_id" value='{{$cotizacion->id}}' >
      @endforeach
      <div class="br"> </div>
       @foreach($errors->get('cotizacion_id') as $message)
       <div class="alert alert-danger">{{$message}}</div>
       @endforeach
      </div>

      <div class="mb-3">
          <label for="formFile" class="form-label">Agregar Archivo:</label>
          <br>
          <input class="form-pdf" type="file"  id="formFile" accept="application/pdf" name="ruta" style=width:100%;>
          @foreach($errors->get('ruta') as $message)
          <div class="alert alert-danger">{{$message}}</div>
          @endforeach
      </div>

      <div style=display:flex;justify-content:center;>
          <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
  </form>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection