@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')

<div style="width: 70% " class="container-form">
    <form action="{{route('registro.update', $unidad->id)}}" method="POST">
    {{ @csrf_field() }}
    {{@method_field('post')}}
    <h1 class="display-4">Editar Unidad</h1><br>
    <div class="form-group">

        <div class="row g-3">
            <div class="col-md-6">
                <h5><label for="tipo">Tipo:</label></h5>  
                <h5><label>{{$unidad->tipo_unidad}}</label></h5>
            </div>
            <div class="col-md-6">
                <h5><label for="pertenece_a">Pertenece a:</label></h5>
                <h5><label for="">{{$unidad->pertenece_a}}</label></h5>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="nombre_unidad">Nombre:</label>
        <input type="text" name="nombre_unidad" class="form-control" autocomplete="off" value="{{old('nombre_unidad')?old('nombre_unidad'): $unidad->nombre_unidad}}">
        @if($errors->has('nombre_unidad'))
            <div class="alert alert-danger" role="alert">{{$errors->first('nombre_unidad')}}</div>
        @endif
    </div>

    <div class="form-group">

        <label for="telefono_unidad">Telefono:</label>
        <input type="tel" name="telefono_unidad" class="form-control" autocomplete="off" value="{{old('telefono_unidad')?old('telefono_unidad'): $unidad->telefono_unidad}}">
        @if($errors->has('telefono_unidad'))
            <div class="alert alert-danger" role="alert">{{$errors->first('telefono_unidad')}}</div>
        @endif

    
    </div>

    

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">GUARDAR</button>
    </div>
    </form>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        if($("#institucion").hasClass('show')){
            $("#facultad").hide();
            $('#facultad').prop("disabled", true);
        }else{
            $("#institucion").hide();
            $('#institucion').prop("disabled", true);
        }

        $("#tipo_unidad").change(function(){
            var selector = $("#tipo_unidad").val();
            console.log(selector);
        
            if(selector == "facultad"){
                $('#institucion').show();
                $('#facultad').hide();
                $('#institucion').prop("disabled", false);
                $('#facultad').prop("disabled", true);
            }
            else{
                $('#institucion').hide();
                $('#facultad').show();
                $('#institucion').prop("disabled", true);
                $('#facultad').prop("disabled", false);
            }
        });
    });
</script>
@endsection