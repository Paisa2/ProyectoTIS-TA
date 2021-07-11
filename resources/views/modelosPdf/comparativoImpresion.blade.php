<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuadro comparativo</title>
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
    .info-institucional {
			font-family:'Times New Roman', Times, serif;
		}
		.nombre {
			float: left;
			text-align: center;
			font-weight: bold;
			line-height: 1.2em;
      font-size: .8rem;
		}
    .nombre .bol {
      font-size: .65rem;
    }
    .emision {
      float: right;
    }
    .fecha {
      width: 10rem;
    }
    .fecha .head {
      width: 100%;
      background-color: #c9c9c9;
      border: 1px solid #000;
      text-align: center;
    }
    .fecha .contenido {
      width: 100%;
      height: 2rem;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
      border-bottom: 1px solid #000;
      text-align: center;
      padding-top: 1rem;
    }
    .sep {
      margin-right: -6.6rem;
      height: 3rem;
      width: 3.3rem;
      float: right;
      border-right: 1px solid #000;
      border-left: 1px solid #000;
      margin-top: 1.3rem;
    }
    .numero {
      display: block;
      text-align: center;
      color: red;
      margin: .4rem 0;
      font-size: 18px;
    }
    .titulo {
      display: inline-block;
      text-align: left;
      margin-top: 2rem;
    }
    .titulo span {
      border-bottom: 1px solid #000;
      font-size: 1.2rem;
      font-weight: bold;
    }
    table {
      border-collapse: collapse;
      table-layout: fixed;
      width: 100%;
      color: #000;
    }
    div.row-0 {
      border-top: 1px solid #000;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
      background-color: #c9c9c9;
      text-align: right;
      letter-spacing: .55rem;
      padding-right: 8%;
      font-size: 12px;
    }
    .comparativo th {
      border: 1px solid #000;
      background-color: #c9c9c9;
      text-align: center;
      font-weight: normal;
      font-size: .8rem;
    }
    .comparativo thead tr th.c-1 {
      width: 5%;
    }
    .comparativo thead tr th.c-2 {
      width: 8%;
    }
    .comparativo thead tr th.c-3 {
      width: 44.5%;
      letter-spacing: .5rem;
    }
    .comparativo thead tr th.c-4 {
      width: 8.5%;
    }
    .comparativo tbody tr td {
      height: 1.3rem;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
      border-bottom: 1px dotted #000;
      font-size: .95rem;
    }
    .comparativo tbody tr td {
      text-align: center;
    }
    .comparativo tbody tr td.dd {
      padding-left: .5rem;
      text-align: start;
    }
    .comparativo tbody tr:last-child td {
      border-bottom: 1px solid #000;
    }
    .observaciones {
      margin-top: .6rem;
      font-size: .9rem;
    }
    .observaciones span {
      display: inline-block;
      width: 88.5%;
      border-bottom: 1px dotted #000;
      height: 1.5em;
      color: #000; 
    }
    .observaciones span:last-child {
      display: block;
      width: 100%;
      border-bottom: 1px dotted #000;
      margin-bottom: .2rem;
    }
    .informacion th {
      border: 1px solid #000;
      background-color: #c9c9c9;
      text-align: center;
      font-size: .8rem;
      font-weight: normal;
    }
    .informacion td {
      border: 1px solid #000;
      height: 3.5rem;
      text-align: center;
      vertical-align: bottom;
    }
  </style>
</head>
<body>
  <div class="info-institucional">
		<div class="nombre">
			UNIVERSIDAD MAYOR DE SAN SIMÓN
			<br>
			FACULTAD DE CIENCIAS Y TECNOLOGÍA
			<br>
			SECCION ADQUISICIONES	
      <br>
      <span class="bol">COCHABAMBA - BOLIVIA</span>
		</div>
    <div class="titulo">
      <span>CUADRO COMPARATIVO DE COTIZACIONES</span>
    </div>
    <div class="emision">
      <div class="fecha">
        <div class="head"><b>EMISION</b></div>
        <div class="contenido">
          {{date("d")}} &nbsp; &nbsp; &nbsp; &nbsp;
          {{date("m")}} &nbsp; &nbsp; &nbsp; &nbsp;
          {{date("Y")}}
        </div>
        <label class="numero">N° {{$comparativo->codigo_cotizacion}}</label>
      </div>
    </div>
    <div class="sep"></div>
	</div>
  <div style="clear:both;"></div>
  <div class="row-0">CASAS COMERCIALES</div>
  <table class="comparativo">
    <thead>
      <tr>
        <th class="c-1">CANT.</th>
        <th class="c-2">UND.</th>
        <th class="c-3">DESCRIPCION</th>
        <th class="c-4">1</th>
        <th class="c-4">2</th>
        <th class="c-4">3</th>
        <th class="c-4">4</th>
        <th class="c-4">5</th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<count($propuestas[2]); $i++)
        <tr>
          <td>{{$propuestas[1][$i]}}</td>
          <td>
            @if(2<count($propuestas))
              {{$propuestas[2][$i]}}
            @endif
          </td>
          <td class="dd">
            @if(3<count($propuestas))
              {{$propuestas[3][$i]}}
            @endif
          </td>
          <td>
            @if(4<count($propuestas))
              {{$propuestas[4][$i]}}
            @endif
          </td>
          <td>@if(5<count($propuestas))
                {{$propuestas[5][$i]}}
              @endif
          </td>
          <td>
            @if(6<count($propuestas))
              {{$propuestas[6][$i]}}
            @endif
          </td>
          <td>
            @if(7<count($propuestas))
              {{$propuestas[7][$i]}}
            @endif
          </td>
          <td>
            @if(8<count($propuestas))
              {{$propuestas[8][$i]}}
            @endif
          </td>
        </tr>
      @endfor
      @for($i=0; $i<20-count($propuestas[2]); $i++)
        <tr>
          <td></td>
          <td></td>
          <td class="dd"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      @endfor
    </tbody>
  </table>
  <div class="observaciones">
    <label>Observaciones: </label>
    <span>{{$comparativo->observaciones_comparativo}}</span>
    <span>
    </span>
  </div>
  <table class="informacion">
    <thead>
      <tr>
        <th>SECCION ADQUISICION</th>
        <th>JEFE DE UNIDAD</th>
        <th>TECNICO RESPONSABLE</th>
        <th>JEFE ADMINISTRATIVO</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$comparativo->unidad_solicitante}}</td>
        <td>{{$comparativo->nombre_jefe_solicitante}}</td>
        <td>{{$comparativo->nombre_tecnico_responsable}}</td>
        <td>{{$comparativo->nombre_jefe_administrativo}}</td>
      </tr>
    </tbody>
  </table>
  
</body>
</html>