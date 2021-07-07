@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/EmitirInforme.css') }}">

@endsection
@section('main')
@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
<div class="container-form">

   <form>
      <div style="width:90%; margin:auto;">
         <br>
         <div class="d-flex justify-content-end"> Cochabamba,{{date("d",strtotime($informe->created_at))}} de {{$meses[date("n",strtotime($informe->created_at))-1]}} de {{date("Y",strtotime($informe->created_at))}}</div>
         <label for="tipo" class="form-label">Señor: {{$comparativo->nombre_solicitante}}</label>
         <br>
         <div class="d-flex justify-content-between">
            <label for="tipo" class="form-label">PRESENTE</label>
            <div class="d-flex">
               <div class="informe-options">
                  <a href="{{route('solicitudCotizacion.index')}}">
                     <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Lista de cotizaciones">
                        <use xlink:href="{{asset('img/icons/list.svg#i-list')}}"></use>
                     </svg>
                  </a>
               </div>
               @if(session('tipo_unidad')!='unidad de gasto')
               <div class="informe-options" id="event-print">
                  <a href="{{route('informe.generarpdf', $informe->id)}}" target="_blank">
                     <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Imprimir" viewBox="0 0 32 32">
                        <!-- <use xlink:href="{{asset('img/icons/print.svg#i-print')}}"></use> -->
                        <path d="M6 2H26L26 8C26.8889 8 27.6424 8.18593 28.2558 8.56078C28.8744 8.93882 29.2772 9.46436 29.533 10.0184C30.0013 11.0332 30.0005 12.2207 30 12.9342C30 12.9566 30 12.9785 30 13V24H26V22H28V13C28 12.2046 27.984 11.4349 27.717 10.8566C27.5978 10.5981 27.4381 10.4049 27.2129 10.2673C26.9826 10.1266 26.6111 10 26 10H6C5.38887 10 5.01744 10.1266 4.78708 10.2673C4.56194 10.4049 4.40223 10.5981 4.28296 10.8566C4.01603 11.4349 4 12.2046 4 13V22H6V24H2V13C2 12.9785 1.99999 12.9566 1.99997 12.9342C1.99949 12.2207 1.99869 11.0332 2.46704 10.0184C2.72277 9.46436 3.12556 8.93882 3.74418 8.56078C4.35757 8.18593 5.11114 8 6 8V2ZM8 8H24V4H8V8ZM6 16H26V18H6V16Z"/>
                        <path class="paper" d="M8 18H10V28.1538H22V18H24V30H8V18Z"/>
                     </svg>
                  </a>
               </div>
               @endif
            </div>
         </div>
         <div class="d-flex justify-content-center"> REF: INFORME DE LA SOLICITUD DE ADQUISICIÓN {{ strtoupper ( $informe->tipo_informe )}}</div>
         <br>

         @if($informe->con_formato)
         <div id="con-formato">
            <br>
            <label for="tipo" class="form-label">De mi consideración</label>
            <p>
               A travez de este presente tengo el bien de informarte a la Unidad de solicitud de adquisición N° {{$comparativo->codigo_solicitud_a}} , ha sido {{ strtoupper ( $informe->tipo_informe )}}
            {!!nl2br($informe->justificacion_informe)!!}
            </p>
            <label for="tipo" class="form-label">Sin otro en particular mos despedimos de us persona muy cordialmente deseandoles exitos en sus funcionaes que desempeñan actualmente.</label>
         </div>
         @else                  
         <div id="sin-formato">
            <p>{!!nl2br($informe->justificacion_informe)!!}</p>                  
         </div>
         @endif
            <!--  inicio de Acordion--->
         <br>
         <div class="accordion" id="accordionExample">
            <div class="card">
               <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     DETALLE
                     </button>
                  </h2>
               </div>

               <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                  
                     <label for="tipo" class="form-label">Unidad Solicitante: {{$comparativo->unidad_solicitante}}</label>
                     <br>
                     <label for="tipo" class="form-label">Jefe de la Unidad Solicitante: {{$comparativo->nombre_jefe_solicitante}}</label>
                     <br>
                     <label for="tipo" class="form-label">Jefe Administrativo: {{$comparativo->nombre_jefe_administrativo}}</label>
                     <br>
                     <label for="tipo" class="form-label">Tecnico Responsable: {{$comparativo->nombre_tecnico_responsable}}</label>
                     @if($informe->tipo_informe=="Aceptado")
                     <br>
                     <label for="tipo" class="form-label">Empresa Seleccionada: {{$informe->empresa_seleccionada}}</label> 
                     @endif
                  </div>
               </div>

               <div class="card">
                  <div class="card-header" id="headingTwo">
                     <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                           ADJUNTOS
                        </button>
                     </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                     <div class="card-body">
                        <label><b>Cuadro Comparativo de Cotizaciones:</b>&nbsp;  <a href="{{route('comparativo.detalle', $comparativo->id)}}" class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_cotizacion}} </a></label><br>
                        @foreach($respuestas as $respuesta)
                        <label><b>Propuesta {{$loop->index+1}}:</b>&nbsp; <a href="{{route('respuestasCotizacion.show', $respuesta->id)}}" class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_cotizacion}} </a></label><br>
                        @endforeach
                        <label><b>Solicitud de Adquisicion:</b>&nbsp; <a href="{{route('solicitud.show', $comparativo->solicitud_a_id)}}"class="btn btn-dark btn-sm" target="_blank">N° {{$comparativo->codigo_solicitud_a}} </a></label><br>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </form>
</div>
@endsection
