<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informe</title>
  <style>
    @page {
			margin: 0;
		}
		* {
			box-sizing: border-box;
		}
    body {
			font-family: Arial, Helvetica, sans-serif;
			padding: 40px 48px 0 48px;
			overflow: hidden;
		}
    .fecha {
      float: right;
    }
    .titulo {
      text-align: center;
    }
    .firma {
      text-align: center;
    }
    .firma span {
      display: inline-block;
      width: 8rem;
      margin: auto;
      border-top: 2px dotted #000;
    }
    .info label{
      margin-bottom: .2rem;
    }
    .info .subtitle {
      font-size: 1.2rem;
      text-decoration: underline;
    }
    .w-10 {
      display: inline-block;
      width: 10rem;
    }
    .w-11 {
      display: inline-block;
      width: 11rem;
    }
    .w-12 {
      display: inline-block;
      width: 12rem;
    }
    .w-13 {
      display: inline-block;
      width: 13rem;
    }
    .w-14 {
      display: inline-block;
      width: 14rem;
    }
  </style>
</head>
<body>

  <div class="fecha"> Cochabamba, {{date("d")}} de {{$meses[date("n")-1]}} de {{date("Y")}}</div>
  <label>Señor: {{$comparativo->nombre_solicitante}}</label><br>
  <label>PRESENTE</label>
  <div style="clear:both;"></div>
  <br>
  <div class="titulo"> REF: INFORME DE LA SOLICITUD DE ADQUISICIÓN {{ strtoupper ( $informe->tipo_informe )}}</div>
  <br>
  <br>
  
  @if($informe->con_formato)
  <div id="con-formato">
    <label>De mi consideración</label>
    <p>A travez de este presente tengo el bien de informarte a la Unidad de solicitud de adquisición N° {{$comparativo->codigo_solicitud_a}} , ha sido {{ strtoupper ( $informe->tipo_informe )}}
      {!!nl2br($informe->justificacion_informe)!!}
    </p>
    <label>Sin otro en particular mos despedimos de us persona muy cordialmente deseandoles exitos en sus funcionaes que desempeñan actualmente.</label>
  </div>
  @else 
  <div id="sin-formato">
    <p>{!!nl2br($informe->justificacion_informe)!!}</p> 
  </div>
  @endif
  <br><br><br><br>
  <div class="firma"><span>firma</span></div>
  <br><br>
  <div class="info">
    <label>Remitente:</label><label> {{$remitente->nombres}} {{$remitente->apellidos}}</label>
    
    <br><br>
    <label class="subtitle">Detalles de solicitud de adquisición</label>
    <br><br>

    <label class="w-13">Solicitante:</label><label> {{$comparativo->nombre_solicitante}}</label><br>
    <label class="w-13">Solicitud de adquisición:</label><label> N° {{$comparativo->codigo_solicitud_a}}</label><br>
    <label class="w-13">Unidad Solicitante:</label><label> {{$comparativo->unidad_solicitante}}</label><br>
    <label class="w-13">Jefe de la Unidad Solicitante:</label><label> {{$comparativo->nombre_jefe_solicitante}}</label>

    <br><br>
    <label class="subtitle">Detalles de cotizaciones</label>
    <br><br>

    <label class="w-10">Jefe administrativo:</label><label> {{$comparativo->nombre_jefe_administrativo}}</label><br>
    <label class="w-10">Tecnico responsable:</label><label> {{$comparativo->nombre_tecnico_responsable}}</label><br><br>
    <label class="w-10">Cuadro comparativo:</label><label> N° {{$comparativo->codigo_cotizacion}}</label><br>
    @foreach($empresas as $empresa)
    <label class="w-10">Propuesta {{$loop->index+1}}:</label><label> N° {{$comparativo->codigo_cotizacion}} - Empresa : {{$empresa[0]}}</label><br>
    @endforeach
    @if($informe->tipo_informe=="Aceptado")
    <br>
    <label class="w-11">Empresa seleccionada:</label><label> {{$informe->empresa_seleccionada}}</label><br>
    @endif
  </div>

</body>
</html>
