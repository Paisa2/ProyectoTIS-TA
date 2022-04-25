@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/comparativoCotizaciones.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">

    <form action="{{route('comparativo.update',$datoscomparativo->id)}}" method="post">
      {{csrf_field()}}
      <div class="titulo d-flex justify-content-center">
    <h1 class="display-4">Cuadro Comparativo de Cotizaciones</h1>
  </div>
  <div class="d-flex justify-content-end" style="margin-top:-5rem;">
    <div class="fecha">
      <table>
        <thead>
          <tr>
            <th colspan="3">EMISION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{date("d",strtotime($datoscomparativo->fecha_comparativo))}}</td>
            <td>{{date("m",strtotime($datoscomparativo->fecha_comparativo))}}</td>
            <td>{{date("Y",strtotime($datoscomparativo->fecha_comparativo))}}</td>
          </tr>
        </tbody>
      </table>
      <label class="numero"><b>N°</b> {{$datoscomparativo->codigo_cotizacion}}</label>
    </div>
  </div>
  
  <div class="row-0"><b>CASAS COMERCIALES</b></div>
  <table class="comparativo">
    <thead>
      <tr>
        <th class="c-1"><b>CANT.</b></th>
        <th class="c-2"><b>UND.</b></th>
        <th class="c-3"><b>DESCRIPCION</b></th>
        <th class="c-4 r-1" id="r-1" data-value="{{0<count($empresas) ? $empresas[0][0] : ''}}">
              @if(0<count($empresas))
                {{$empresas[0][0]}}
              @endif
              <br><b>1</b></th>
        <th class="c-4 r-2" id="r-2" data-value="{{1<count($empresas) ? $empresas[1][0] : ''}}">
              @if(1<count($empresas))
                {{$empresas[1][0]}}
              @endif
              <br><b>2</b></th>
        <th class="c-4 r-3" id="r-3" data-value="{{2<count($empresas) ? $empresas[2][0] : ''}}">
              @if(2<count($empresas))
                {{$empresas[2][0]}}
              @endif
              <br><b>3</b></th>
        <th class="c-4 r-4" id="r-4" data-value="{{3<count($empresas) ? $empresas[3][0] : ''}}">
              @if(3<count($empresas))
                {{$empresas[3][0]}}
              @endif
              <br><b>4</b></th>
        <th class="c-4 r-5" id="r-5" data-value="{{4<count($empresas) ? $empresas[4][0] : ''}}">
              @if(4<count($empresas))
                {{$empresas[4][0]}}
              @endif
              <br><b>5</b></th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<count($propuestas[2]); $i++)
        <tr>
          <td>{{$propuestas[1][$i]}}</td>
          <td>@if(2<count($propuestas))
                {{$propuestas[2][$i]}}
              @endif
          </td>
          <td class="dd">@if(3<count($propuestas))
                {{$propuestas[3][$i]}}
              @endif
          </td>
          <td class="r-1">@if(4<count($propuestas))
                {{$propuestas[4][$i]}}
              @endif
          </td>
          <td class="r-2">@if(5<count($propuestas))
                {{$propuestas[5][$i]}}
              @endif
          </td>
          <td class="r-3">@if(6<count($propuestas))
                {{$propuestas[6][$i]}}
              @endif
          </td>
          <td class="r-4">@if(7<count($propuestas))
                {{$propuestas[7][$i]}}
              @endif
          </td>
          <td class="r-5">@if(8<count($propuestas))
                {{$propuestas[8][$i]}}
              @endif
          </td>
        </tr>
      @endfor
      @for($i=0; $i<10-count($propuestas[2]); $i++)
       <tr>
       <td></td>
       <td></td>
       <td></td>
       <td class="r-1"></td>
       <td class="r-2"></td>
       <td class="r-3"></td>
       <td class="r-4"></td>
       <td class="r-5"></td>
       </tr>
      @endfor
       <tr>
       <td colspan="3"><b>TOTALES</b></td>
       <td class="r-1">
       @if(0<count($empresas))
          {{$empresas[0][1]}}
       @endif
        </td>
       <td class="r-2">
       @if(1<count($empresas))
          {{$empresas[1][1]}}
       @endif
        </td>
       <td class="r-3">
       @if(2<count($empresas))
          {{$empresas[2][1]}}
       @endif
        </td>
       <td class="r-4">
       @if(3<count($empresas))
          {{$empresas[3][1]}}
       @endif
        </td>
       <td class="r-5">
       @if(4<count($empresas))
          {{$empresas[4][1]}}
       @endif
        </td>
       </tr>
    </tbody>
  </table>
  @if($totaltotal == 0)
  <div id="off" class="d-none"></div>
  @endif
  <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Presupuesto de la Unidad Solicitante:</label>
  <label for="exampleInputEmail1" class="form-label">{{$presupuesto}} Bs.</label>
  <br>
  <br>
  <label for="exampleInputEmail1" class="form-label">Desicion:</label>
  <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <!--{{ (old('tipo_item') == "Generico") ? "checked" : ""}}-->
    <input type="radio" class="btn-check" name="tipo_item" id="btnradio1" autocomplete="off" value="ACEPTAR" checked="">
    <label class="btn btn-outline-primary bb" for="btnradio1">ACEPTAR</label>
    <!--{{ (old('tipo_item') == "Especifico") ? "checked" : ""}}-->
    <input type="radio" class="btn-check" name="tipo_item" id="btnradio2" autocomplete="off" value="RECHAZAR">
    <label class="btn btn-outline-primary bb" for="btnradio2">RECHAZAR</label>
    </div>
  <label for="observaciones" class="labelcompa">Empresa Recomendada: </label>
  <select class="form-control" name="empresa" id="empresas">
      @foreach($empresas as $empresa)
        @if($empresa[0]==$datoscomparativo->empresa_recomendada)
        <option id=".r-{{$loop->index +1}}" value="{{$empresa[0]}}" selected>{{$empresa[0]}}</option>
        @else
        <option id=".r-{{$loop->index +1}}" value="{{$empresa[0]}}">{{$empresa[0]}}</option>
        @endif
      @endforeach
  </select>
  </div>
  <div class="mb-3">
    <label for="observaciones" class="labelcompa">Observaciones: </label>
    <br>
    <input type="text" name="observaciones" id="observacion" class="form-control" value="{{ old('observaciones') ? old('observaciones') : ($totaltotal == 0 ? 'Ninguna empresa respondió' : '') }}" autocomplete="off">
  </div>
  <table class="informacion">
    <thead>
      <tr>
        <th><b>SECCION ADQUISICION</b></th>
        <th><b>JEFE DE UNIDAD</b></th>
        <th><b>TECNICO RESPONSABLE</b></th>
        <th><b>JEFE ADMINISTRATIVO</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$datoscomparativo->unidad_solicitante}}</td>
        <td>{{$datoscomparativo->nombre_jefe_solicitante}}</td>
        <td>{{$datoscomparativo->nombre_tecnico_responsable}}</td>
        <td>{{$datoscomparativo->nombre_jefe_administrativo}}</td>
      </tr>
    </tbody>
  </table> 
  <div style=display:flex;justify-content:center;>
    <button type="submit" class="btn btn-primary">GUARDAR</button>
  </div>    
    </form>
</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script>
  $('input[name="tipo_item"]').on('change',function()
  {
    $('select[name="empresa"]').attr('disabled',this.value=="RECHAZAR")
  });
</script>
<script>
$(window).on("load",function(){
  $($("#empresas option:selected").attr("id")).addClass("active");
  $("#empresas").on("change",function(){
    for(var i=1;i<=5;i++){
      $(".r-"+i).removeClass("active");
    }
    $("."+$("th[data-value='"+$(this).val()+"']").attr("id")).addClass("active");

  });
  if ($('#off').attr('id') == 'off') {
    $('#btnradio2').trigger('click');
    $('input[name="tipo_item"]').off('change');
    $('#observacion').on('keydown', (e)=>{
      e.preventDefault();
    });
    $('#btnradio1').on('click', function(){
      $('#btnradio2').trigger('click');
    });
  }
});
</script>


@endsection