@extends('base')

@section('title')
Subir PDF
@endsection

@section('head')
<title>Items de Gasto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
@endsection

@section('main')

<div class="container my-4">
    @foreach($cotizaciones as $cotizacion)
  <form method="POST" action="{{ route('formpost', $cotizacion->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <h1 class="display-4">Agregar Documento PDF</h1>
        <br>
      <div class="mb-3">  
      <label for="disabledSelect" class="form-label">Codigo de Cotización a la que se agregara el documento PDF:</label>
      <!--<select class="form-control" name="cotizacion_id" id="cotizacion_id">
        <option hidden selected>Seleccione</option>
        @foreach($cotizaciones as $cotizacion)
        <option value="{{$cotizacion->id}}">{{$cotizacion->razon_social}}</option>
        @endforeach
      </select>-->
      @foreach($cotizaciones as $cotizacion)
      <input type="text" class="form-control" id="cotizacion_id" name="cotizacion_id" value='{{$cotizacion->numero_cotizacion}}' disabled>
      @endforeach
      <div class="br"> </div>
       @foreach($errors->get('cotizacion_id') as $message)
       <div class="alert alert-danger">{{$message}}</div>
       @endforeach
      </div>
      <br>
<!--
      <div class="mb-3">
          <label for="formFile" class="form-label">Agregar Archivo:</label>
          <br>
          <input class="custom-file-input" type="file"  id="formFile" accept="application/pdf" name="ruta" style=width:100%;>
          @foreach($errors->get('ruta') as $message)
          <div class="alert alert-danger">{{$message}}</div>
          @endforeach
      </div>
      -->
      <div class="mb-3">
          <label for="formFile" class="form-label">Agregar Archivo:</label>
      <div class="input-group mb-3">
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="application/pdf" name="ruta" >
        <label class="custom-file-label" for="inputGroupFile01">Seleccione el Archivo PDF</label>
        </div>
      </div>
      @foreach($errors->get('ruta') as $message)
          <div class="alert alert-danger">{{$message}}</div>
      @endforeach
      </div>

      <div style=display:flex;justify-content:center;>
          <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
  </form>
  @endforeach
</div>

@endsection

@section('scripts')
<script>$(document).ready(function () {
  bsCustomFileInput.init()
})
</script>
@endsection