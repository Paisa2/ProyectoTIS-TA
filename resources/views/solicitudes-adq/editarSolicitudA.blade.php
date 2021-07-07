@extends('base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/solicitarAdq.css') }}">
@endsection

@section('main')
<div class="container-form">
  <form action="{{route('solicitud.update', $edicion->id)}}" method="post" novalidate>
    {{csrf_field()}}
    {{method_field('put')}}
    <div class="col-md-12">
        <h1 class="display-4">Edición de Solicitud de Adquisición</h1>
    </div>
    <div class="row g-3">
        <div class="col-md-6 d-flex align-items-center">
            <label for="tipo" class="form-label">Tipo: {{$edicion->tipo_solicitud_a}}</label>
        </div>
        <div class="col-md-6">
            <label for="fecha" class="form-label">Fecha de entrega:</label>
            <input type="date" name="fecha" id="" value="{{ old('fecha') ? date("Y-m-d",strtotime(old('fecha'))) : date("Y-m-d",strtotime($edicion->fecha_entrega)) }}" class="form-control" min=<?php $fecha=date("Y-m-d"); echo date("Y-m-d", strtotime($fecha."+ 3 days"));?>>
            @foreach($errors->get('fecha') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-12">
            <label for="justificacion" class="form-label">Justificacion:</label>
            <textarea name="justificacion" id="justificacion" class="form-control" cols="30" rows="0" style="resize: none">{{ old('justificacion') ? old('justificacion') : $edicion->justificacion_solicitud_a }}</textarea>
            @foreach($errors->get('justificacion') as $message)
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-12" id="tabla-compra">

        @if($edicion->tipo_solicitud_a == "Compra")
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
              <td><input id="nc-{{$i+1}}" type="text" name="detalle[numero][u{{$i}}]" value="{{old('detalle.numero.u'.$i) ? old('detalle.numero.u'.$i) : $detalles[0][$i]}}" autocomplete="off"></td>
              <td class="articulo">
                <select id="ac-{{$i+1}}" name="detalle[detalle][d{{$i}}]">
                  <option hidden selected value="">Seleccione</option>
                  @foreach($adquisicion as $solicitudes)
                      <option value="{{ $solicitudes->nombre_item }}" {{ old('detalle.detalle.d'.$i) == $solicitudes->nombre_item || $detalles[1][$i] == $solicitudes->nombre_item ? 'selected' : '' }}>{{ $solicitudes->nombre_item }}</option>
                  @endforeach
                </select>
              </td>
              <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]" value="{{old('detalle.cantidad.c'.$i) ? old('detalle.cantidad.c'.$i) : $detalles[2][$i]}}" autocomplete="off"></td>
              <td><input type="text" name="detalle[unidad][u{{$i}}]" value="{{old('detalle.unidad.u'.$i) ? old('detalle.unidad.u'.$i) : $detalles[3][$i]}}" autocomplete="off"></td>
              <td><input id="pc-{{$i+1}}" type="number" min="1" name="detalle[precio][p{{$i}}]" value="{{old('detalle.precio.p'.$i) ? old('detalle.precio.p'.$i) : $detalles[4][$i]}}" autocomplete="off"></td>
            </tr>
            @endfor
            <tr>
              <td colspan="4">TOTAL</td>
              <td><input id="total-c" type="text" name="total" value="{{old('total') ? old('total') : $edicion->total_solicitud_a}}" autocomplete="off"></td>
            </tr>
          </tbody>
        </table>
        @endif

        @if($edicion->tipo_solicitud_a == "Alquiler")
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
              <td><input id="na-{{$i+1}}" type="text" name="detalle[numero][u{{$i}}]" value="{{old('detalle.numero.u'.$i) ? old('detalle.numero.u'.$i) : $detalles[0][$i]}}" autocomplete="off"></td>
              <td class="articulo"><input id="aa-{{$i+1}}" type="text" name="detalle[detalle][d{{$i}}]" value="{{old('detalle.detalle.d'.$i) ? old('detalle.detalle.d'.$i) : $detalles[1][$i]}}" autocomplete="off"></td>
              <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]" value="{{old('detalle.cantidad.c'.$i) ? old('detalle.cantidad.c'.$i) : $detalles[2][$i]}}" autocomplete="off"></td>
              <td>
                  <select name="detalle[unidad][u{{$i}}]">
                  <option hidden selected value="">Seleccione</option>
                    <option value="Horas" {{ old('detalle.unidad.u'.$i) == 'Horas' || $detalles[3][$i] == 'Horas' ? 'selected' : '' }}>Horas</option>
                    <option value="Dias" {{ old('detalle.unidad.u'.$i) == 'Dias' || $detalles[3][$i] == 'Dias' ? 'selected' : '' }}>Dias</option>
                    <option value="Meses" {{ old('detalle.unidad.u'.$i) == 'Meses' || $detalles[3][$i] == 'Meses' ? 'selected' : '' }}>Meses</option>
                    <option value="Años" {{ old('detalle.unidad.u'.$i) == 'Años' || $detalles[3][$i] == 'Años' ? 'selected' : '' }}>Años</option>
                  </select>
                </td>
              <td><input id="pa-{{$i+1}}" type="number" min="1" name="detalle[precio][p{{$i}}]" value="{{old('detalle.precio.p'.$i) ? old('detalle.precio.p'.$i) : $detalles[4][$i]}}" autocomplete="off"></td>
            </tr>
            @endfor
            <tr>
              <td colspan="4">TOTAL</td>
              <td><input id="total-a" type="text" name="total" value="{{old('total') ? old('total') : $edicion->total_solicitud_a}}" autocomplete="off" style="user-select: none;"></td>
            </tr>
          </tbody>
        </table>
        @endif

      </div>
    </div>
    @foreach($errors->get('total') as $message)
      <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">GUARDAR</button>
    </div>
  </form>

</div>

@endsection
@section('scripts')
<script>
    $(window).on("load", function(){
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