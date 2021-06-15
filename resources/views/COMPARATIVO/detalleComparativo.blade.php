@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/comparativoCotizaciones.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">

    <form action="{{route('comparativo.update',$datoscomparativo->id)}}" method="get">
      {{csrf_field()}}
      <div class="titulo d-flex justify-content-center">
    <h1 class="display-4">Detalles del Cuadro Comparativo</h1>
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
        <th class="c-4"><b>1</b></th>
        <th class="c-4"><b>2</b></th>
        <th class="c-4"><b>3</b></th>
        <th class="c-4"><b>4</b></th>
        <th class="c-4"><b>5</b></th>
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
          <td>@if(4<count($propuestas))
                {{$propuestas[4][$i]}}
              @endif
          </td>
          <td>@if(5<count($propuestas))
                {{$propuestas[5][$i]}}
              @endif
          </td>
          <td>@if(6<count($propuestas))
                {{$propuestas[6][$i]}}
              @endif
          </td>
          <td>@if(7<count($propuestas))
                {{$propuestas[7][$i]}}
              @endif
          </td>
          <td>@if(8<count($propuestas))
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
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       </tr>
      @endfor
    </tbody>
  </table>
  <div class="mb-3">
  <label for="observaciones" class="labelcompad"><b>EMPRESA RECOMENDADA: </b></label>
  <label class="labelcompad"> {{$datoscuadrocomparativo->empresa_recomendada}}</label>
  </div>
  <div class="mb-3">
    <label for="observaciones" class="labelcompad"><b>OBSERVACIONES:</b> </label>
    <label class="labelcompad">{{$datoscuadrocomparativo->observaciones_comparativo}}</label>
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
    </form>
</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")

@endsection