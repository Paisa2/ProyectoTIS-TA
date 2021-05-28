@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
    <div class="container my-4">
    <form action="{{route('solicitud.store')}}" method="post">
        {{csrf_field()}}
        <div class="col-md-12">
            <h1 class="display-4">Solicitar Adquisicion</h1>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="compra">Compra</option>
                    <option value="alquiler">Alquiler</option>
                </select><br>
                @foreach($errors->get('tipo') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha de entrega</label>
                <input type="date" name="fecha" id="" class="form-control" min=<?php $fecha=date("Y-m-d"); echo date("Y-m-d", strtotime($fecha."+ 3 days"));?>>
                @foreach($errors->get('fecha') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12">
                <label for="justificacion" class="form-label">Justificacion</label>
                <textarea name="justificacion" id="justificacion" class="form-control" cols="30" rows="0" style="resize: none">{{old('justificacion')}}</textarea>
                @foreach($errors->get('justificacion') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
        </div>
        <input class="d-none" type="text" name="detalle" id="detalle">
        <div class="row">
            <div class="col-md-12" id="tabla-compra">
                <table class="table table-bordered" id="compra">
                    <style>
                        table{
                            table-layout: fixed;
                        }
                    </style>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unidad</th>
                            {{--  <th>Precio Unidad</th>  --}}
                            <th>Precio</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($i=0; $i<5; $i++)
                        <tr>
                            <th>
                                <div class="dropdown">
                                    <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true">
                                      Seleccione un item
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                        @foreach($adquisicion as $solicitudes)
                                        <li class="dropdown-item" value="{{ $solicitudes->id }}">{{ $solicitudes->nombre_item }}</li>
                                        @endforeach
                                    </ul>
                                  </div>
                                  <span class="d-none"></span>
                                  {{-- <select name="item" id="especifico" class="form-control">
                                    @foreach($adquisicion as $solicitudes)
                                        <option value="{{ $solicitudes->id }}">{{ $solicitudes->nombre_item }}</option>
                                    @endforeach
                                </select> --}}
                            </th>
                            <th contenteditable="true" class="only-numbers"></th>
                            {{--  <th contenteditable="true" class="only-numbers"></th>  --}}
                            <th contenteditable="true" class="only-numbers"></th>
                        </tr>
                        @endfor
                    </tbody>
               </table>
            </div>
            <div class="col-md-12" id="tabla-alquiler">   
               <table class="table table-bordered" id="alquiler">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Meses de Duracion</th>
                        {{--  <th>Precio Mensual</th>  --}}
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0; $i<5; $i++)
                    <tr>
                        <th contenteditable="true"></th>
                        <th contenteditable="true" class="only-numbers"></th>
                        {{--  <th contenteditable="true"></th>  --}}
                        <th contenteditable="true" class="only-numbers"></th>
                    </tr>
                    @endfor
                </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" id="enviar">Enviar</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>´
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    let selectorN = ".only-numbers";
    $(selectorN).on("keydown", function(e) {
    if(isNaN(parseInt(e.key)) && e.key!="Backspace"){
      e.preventDefault();
    }else{
        if("´@-*{}[]•◘○♦♣♠☺☻".includes(e.key)){
            e.preventDefault();
        }
    }
    });
    $(document).ready(function(){
        $("#alquiler").hide();
        $("#tipo").change(function(){
            var selector = $("#tipo").val();
            console.log(selector);
        
        if(selector == "alquiler"){
            $('#alquiler').show();
            $('#compra').hide();
        }
        else{
            $('#alquiler').hide();
            $('#compra').show();
        }
        });
    });
    $(document).ready(function(){
    $(".dropdown-item").on("click", function(){
      $(this).parent().parent().children(":first").text($(this).text());
      $(this).parent().parent().parent().children(":last").text($(this).text());
    });
  
    $("#enviar").on("mousedown", function(){
      $("th .dropdown").remove();
      if($('#tipo').val() == 'compra'){
        var html = $("#tabla-compra").html();
      }else{
        var html = $("#tabla-alquiler").html();
      }
      html = html.replace(/contenteditable="true"/g, "")
      .replace(/<span class="d-none">/g, "")
      .replace(/<\/span>/g, "")
      .replace(/  /g, "")
      .replace(/class="only-numbers"/g,"");
      $("#detalle").val(html);
    });
    });
  </script>
@endsection