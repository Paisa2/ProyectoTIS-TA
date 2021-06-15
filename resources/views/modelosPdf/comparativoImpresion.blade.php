<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
      height: 3rem;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
      border-bottom: 1px solid #000;
      text-align: center;
    }
    .fecha .contenido span {
      display: inline-block;
      margin: 0 auto;
      width: 33.33%;
      height: 3rem;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
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
      width: 5%;
    }
    .comparativo thead tr th.c-3 {
      width: 45%;
      letter-spacing: .5rem;
    }
    .comparativo thead tr th.c-4 {
      width: 10.1%;
    }
    .comparativo tbody tr td {
      height: 1.3rem;
      border-left: 1px solid #000;
      border-right: 1px solid #000;
      border-bottom: 1px dotted #000;
    }
    .comparativo tbody tr:last-child td {
      border-bottom: 1px solid #000;
    }
    .observaciones {
      margin-top: .5rem;
      font-size: .9rem;
    }
    .observaciones span {
      display: inline-block;
      width: 88.5%;
      border-bottom: 1px dotted #000;
      height: 1.5em;
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
          <span></span>
        </div>
        <label class="numero">N° XXXXXX</label>
      </div>
    </div>
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
      @for($i=0; $i<20; $i++)
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
  <div class="observaciones">
    <label>Observaciones: </label>
    <span></span>
    <span></span>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
  
</body>
</html>