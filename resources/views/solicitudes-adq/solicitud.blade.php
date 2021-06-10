@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/solicitarAdq.css') }}">
@endsection

@section('main')
<div class="container my-4">
  <form action="{{route('solicitud.store')}}" method="post" novalidate>
    {{csrf_field()}}
    <div class="col-md-12">
        <h1 class="display-4">Solicitar Adquisición</h1>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label for="tipo" class="form-label">Tipo:</label>
            <select name="tipo" id="tipo" class="form-control">
                <option {{ old('tipo') == "Compra" ? 'selected' : '' }} value="Compra">Compra</option>
                <option {{ old('tipo') == "Alquiler" ? 'selected' : '' }} value="Alquiler">Alquiler</option>
            </select><br>
            @foreach($errors->get('tipo') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha de entrega:</label>
            <input type="date" name="fecha" id="" value="{{old('fecha')}}" class="form-control" min=<?php $fecha=date("Y-m-d"); echo date("Y-m-d", strtotime($fecha."+ 3 days"));?>>
            @foreach($errors->get('fecha') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-12">
            <label for="justificacion" class="form-label">Justificacion:</label>
            <textarea name="justificacion" id="justificacion" class="form-control" cols="30" rows="0" style="resize: none">{{old('justificacion')}}</textarea>
            @foreach($errors->get('justificacion') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12" id="tabla-compra">

        <table class="tabla-compra" id="compra">
          <thead>
            <tr>
              <th class="c-0">N°</th>
              <th class="c-1">Item</th>
              <th class="c-2">Cantidad</th>
              <th class="c-2">Unidad</th>
              <th class="c-2">Precio (Bs.)</th>
            </tr>
          </thead>
          <tbody>
          @for($i=0; $i<10; $i++)
            <tr>
              <td><input id="nc-{{$i+1}}" type="text" name="detalle[numero][u{{$i}}]" autocomplete="off"></td>
              <td class="articulo">
                <select id="ac-{{$i+1}}" name="detalle[articulo][a{{$i}}]">
                  <option hidden selected value="">Seleccione</option>
                  @foreach($adquisicion as $solicitudes)
                      <option value="{{ $solicitudes->nombre_item }}">{{ $solicitudes->nombre_item }}</option>
                  @endforeach
                </select>
              </td>
              <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]" autocomplete="off"></td>
              <td><input type="text" name="detalle[unidad][u{{$i}}]" autocomplete="off"></td>
              <td><input id="pc-{{$i+1}}" type="number" min="1" name="detalle[precio][p{{$i}}]" autocomplete="off"></td>
            </tr>
            @endfor
            <tr>
              <td colspan="4">TOTAL</td>
              <td><input id="total-c" type="text" name="total" value="{{old('total')}}" autocomplete="off"></td>
            </tr>
          </tbody>
        </table>
                  
        <table class="tabla-alquiler" id="alquiler">
          <thead>
            <tr>
              <th class="c-0">N°</th>
              <th class="c-1">Servicio</th>
              <th class="c-2">Duracion</th>
              <th class="c-2">Periodo</th>
              <th class="c-2">Precio (Bs.)</th>
            </tr>
          </thead>
          <tbody>
            @for($i=0; $i<10; $i++)
            <tr>
              <td><input id="na-{{$i+1}}" type="text" name="detalle[numero][u{{$i}}]" autocomplete="off"></td>
              <td class="articulo"><input id="aa-{{$i+1}}" type="text" name="detalle[articulo][a{{$i}}]" autocomplete="off"></td>
              <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]" autocomplete="off"></td>
              <td>
                  <select name="detalle[unidad][u{{$i}}]">
                  <option hidden selected value="">Seleccione</option>
                    <option value="Horas">Horas</option>
                    <option value="Dias">Dias</option>
                    <option value="Meses">Meses</option>
                    <option value="Años">Años</option>
                  </select>
                </td>
              <td><input id="pa-{{$i+1}}" type="number" min="1" name="detalle[precio][p{{$i}}]" autocomplete="off"></td>
            </tr>
            @endfor
            <tr>
              <td colspan="4">TOTAL</td>
              <td><input id="total-a" type="text" name="total" value="{{old('total')}}" autocomplete="off"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    @foreach($errors->get('total') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" id="enviar">REGISTRAR</button>
    </div>
    {{-- <div class="d-flex justify">
        <button type="submit" class="btn btn-primary" id="enviar">Registrar y Enviar</button>
    </div> --}}
  </form>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>´
<!-- //<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script>
    $(window).on("load", function(){
      hideShowTable();
      $("#tipo").change(hideShowTable);
      function hideShowTable(){
        var selector = $("#tipo").val();
        if(selector == "Alquiler"){
            $('#alquiler').show();
            $('#compra').hide();
            $('#compra input,#compra select').prop('disabled', true);
            $('#alquiler input,#alquiler select').prop('disabled', false);
        }
        else{
            $('#alquiler').hide();
            $('#compra').show();
            $('#compra input,#compra select').prop('disabled', false);
            $('#alquiler input,#alquiler select').prop('disabled', true);
        }
      }
        $("#compra select").change(function(){
          let id=$(this).attr("id");
          let tipo=id.charAt(1);
          let numero=id.charAt(id.length-1);
          if(id.charAt(id.length-2) != "-"){
              numero=id.charAt(id.length-2)+numero;
          }
          $('#n'+tipo+'-'+numero).val(numero);
        });
        $("#alquiler .articulo input").on("keypress",function(){
          if($(this).val() == ""){
            let id=$(this).attr("id");
            let tipo=id.charAt(1);
            let numero=id.charAt(id.length-1);
            if(id.charAt(id.length-2) != "-"){
              numero=id.charAt(id.length-2)+numero;
            }
            $('#n'+tipo+'-'+numero).val(numero);
          }
        });
        $("#compra td:last-child input, #alquiler td:last-child input").on("keyup", function(){
          let id = $(this).attr("id");
          let tipo = id.charAt(1);
          let total = 0;
          let value = 0;
          for(var i=1; i<=16; i++){
            value = parseInt($("#p"+tipo+"-"+i).val());
            if(!isNaN(value)){//value es numero?
              total = total + value;
            }
          }
          if(total > 0){
            $("#total-"+tipo).val(total);
          }else{
            $("#total-"+tipo).val("");
          }
        });
        $("table tbody tr td:first-child, #total-c, #total-a").on("keydown",function(e){
          e.preventDefault();
        });
    });
    
  </script>
@endsection