@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
<!-- codigo importante -->
<div style="width:70%; margin:24px auto;">

  <form action="/solicitudes-de-items" method="post">
      {{csrf_field()}}
    <h1 class="display-4">Solicitar registro de items</h1>
    <br>
    <div class="mb-3">
      <label for="para" class="form-label">Para:</label>
      <select name="para_usuario_id" id="para" class="form-control">
        <option hidden selected value="">Seleccione</option>
        @foreach($destinatarios as $destinatario)
        <option {{ old('para_usuario_id') == $destinatario->id ? 'selected' : '' }} value="{{$destinatario->id}}">{{$destinatario->nombres . " " . $destinatario->apellidos}} / {{$destinatario->nombre_rol}} / {{$destinatario->nombre_unidad}}</option>
        @endforeach
      </select>
      @foreach($errors->get('para_usuario_id') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <div class="mb-3">
      <label for="solicitud" class="form-label">Solicitud:</label>
      <br>
      <textarea name="detalle_solicitud_item" id="solicitud" class="form-control" rows="8"></textarea>
      @foreach($errors->get('detalle_solicitud_item') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>  

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">ENVIAR</button>
    </div>

  </form>
</div>
<!-- fin codigo importante -->
  
@endsection