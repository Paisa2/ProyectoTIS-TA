@extends('base')
@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection
@section('main')
<div class="container my-4">
    

    <form action="{{route('registro.store')}}" method="POST">
    {{ @csrf_field() }}
    <h1>Registrar Unidades</h1>
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select class="form-select" name="tipo_unidad" id="tipo_unidad">
            <option value="unidad de gasto">Unidad De Gasto</option>
            <option value="unidad de administrativa">Unidad Administrativa</option>
            <option value="facultad">Facultad</option>
        </select>
        @foreach($errors->get('tipo_unidad') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
    </div>

    <div class="form-group">
        <label for="nombre_unidad">Nombre</label>
        <input type="text" name="nombre_unidad" class="form-control" autocomplete="off" value="{{ old('nombre_unidad') }}">
        @if($errors->has('nombre_unidad'))
            <div class="alert alert-danger" role="alert">{{$errors->first('nombre_unidad')}}</div>
        @endif
    </div>

    <div class="form-group">
    <label for="pertenece_a">Pertenece A</label>
        <select name="unidad_id" id="institucion" class="form-select">
            @foreach($instituciones as $Institucion)
                <option value="{{ $Institucion->id }}">{{ $Institucion->nombre_unidad }}</option>
            @endforeach
        </select>

        <select name="unidad_id" id="facultad" class="form-select">
            @foreach($facultades as $facultad)
                <option value="{{ $facultad->id }}">{{ $facultad->nombre_unidad }}</option>
            @endforeach
        </select> 
        @foreach($errors->get('unidad_id') as $message)
        <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach
    </div>
    <br>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
    </form>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-1.6.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#institucion").hide();
        $('#institucion').prop("disabled", true);
        $("#tipo_unidad").change(function(){
            var selector = $("#tipo_unidad").val();
            console.log(selector);
        
        if(selector == "facultad"){
            $('#institucion').show();
            $('#facultad').hide();
            $('#institucion').removeProp("disabled");
            $('#facultad').prop("disabled", true);
        }
        else{
            $('#institucion').hide();
            $('#facultad').show();
            $('#institucion').prop("disabled", true);
            $('#facultad').removeProp("disabled");
        }
        });
    });
</script>
@endsection
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container my-4">
    <h1>Registrar Unidades</h1>

    <form action="{{route('registro.store')}}" method="POST">
    {{ @csrf_field() }}

    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select class="form-control" name="tipo_unidad" id="tipo_unidad">
            <option value="unidad de gasto">Unidad De Gasto</option>
            <option value="unidad de administrativa">Unidad Administrativa</option>
            <option value="facultad">Facultad</option>
        </select>
        @foreach($errors->get('tipo_unidad') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
    </div>

    <div class="form-group">
        <label for="nombre_unidad">Nombre</label>
        <input type="text" name="nombre_unidad" class="form-control" autocomplete="off" value="{{ old('nombre_unidad') }}">
        @if($errors->has('nombre_unidad'))
            <div class="alert alert-danger" role="alert">{{$errors->first('nombre_unidad')}}</div>
        @endif
    </div>

    <div class="form-group">
    <label for="pertenece_a">Pertenece A</label>
        <select name="unidad_id" id="institucion" class="form-control">
            @foreach($instituciones as $Institucion)
                <option value="{{ $Institucion->id }}">{{ $Institucion->nombre_unidad }}</option>
            @endforeach
        </select>

        <select name="unidad_id" id="facultad" class="form-control">
            @foreach($facultades as $facultad)
                <option value="{{ $facultad->id }}">{{ $facultad->nombre_unidad }}</option>
            @endforeach
        </select>
        @foreach($errors->get('unidad_id') as $message)
        <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach
    </div>



    <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-1.6.2.min.js"></script>
<script>
    $(document).ready(function(){
        $("#institucion").hide();
        $('#institucion').prop("disabled", true);
        $("#tipo_unidad").change(function(){
            var selector = $("#tipo_unidad").val();
            console.log(selector);
        
        if(selector == "facultad"){
            $('#institucion').show();
            $('#facultad').hide();
            $('#institucion').removeProp("disabled");
            $('#facultad').prop("disabled", true);
        }
        else{
            $('#institucion').hide();
            $('#facultad').show();
            $('#institucion').prop("disabled", true);
            $('#facultad').removeProp("disabled");
        }
        });
    });
</script>
</html> --}}