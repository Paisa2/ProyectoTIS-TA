@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
<!-- codigo importante -->

<div style="width:90%; margin:24px auto;">
  <form action="/roles" method="post">
    {{csrf_field()}}
    <h1>Registro de rol</h1>
    <br>

    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre:</label>
      <input type="text" name="nombre_rol" id="nombre" value="{{old('nombre_rol')}}" class="form-control">
      @foreach($errors->get('nombre_rol') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <label class="form-label">Permisos:</label>
    <div class="mb-3" style="width:60%; margin:auto;">
      <div class="row">
        <div class="col d-flex justify-content-center">Modulo</div>
        <div class="col d-flex justify-content-center">Visualizar</div>
        <div class="col d-flex justify-content-center">Crear</div>
        <div class="col d-flex justify-content-center">Editar</div>
      </div>
      <div>
        @foreach($modulos as $modulo)
        <div class="row">
          <div class="col">{{$modulo->modulo}}</div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->visualizar_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->visualizar_id, old('permisos'))) checked @endif>
          </div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->crear_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->crear_id, old('permisos'))) checked @endif>
          </div>
          <div class="col d-flex justify-content-center">
            <input type="checkbox" name="permisos[]" value="{{$modulo->editar_id}}" class="form-check-input" @if(is_array(old('permisos')) && in_array($modulo->editar_id, old('permisos'))) checked @endif>
          </div>
        </div>
        @endforeach
      </div>
      @foreach($errors->get('permisos') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
      @endforeach
    </div>

    <div class="d-flex justify-content-center">
      <button type="submit" class="btn btn-primary">REGISTRAR</button>
    </div>
    
  </form>
</div>

<!-- fin codigo importante -->

@endsection