@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/EmitirInforme.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
@section('main')
<div class="container-form">

   <form>
      <div style="width:90%; margin:auto;">
         <br>
         <div class="d-flex justify-content-end"> Cochabamba,{{date("d",strtotime($informe->created_at))}} de {{$meses[date("n",strtotime($informe->created_at))-1]}} de {{date("Y",strtotime($informe->created_at))}}</div>
         <label for="tipo" class="form-label">Señor: {{$comparativo->nombre_solicitante}}</label>
         <br>
         <label for="tipo" class="form-label">PRESENTE</label>
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
                     Some placeholder content for the second accordion panel. This panel is hidden by default.
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </form>
</div>
@endsection
