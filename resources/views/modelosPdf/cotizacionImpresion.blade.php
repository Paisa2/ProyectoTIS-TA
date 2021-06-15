<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title>Solicitud</title>
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
			margin-left: 1rem;
			font-family:'Times New Roman', Times, serif;
			font-size: 20px;
		}
		.nombre {
			float: left;
			text-align: center;
			font-weight: bold;
			line-height: 1.2em;
		}
		.contactos {
			float: right;
			text-align: right;
			line-height: 1em;
		}
		.titulo {
			font-family: Helvetica;
			text-align: center;
			font-size: 32px;
			font-weight: bold;
			line-height: 1em;
			letter-spacing: 1.5px;
			text-decoration: underline;
		}
		.numero {
			float: right;
			line-height: 1em;
			font-family: 'Times New Roman', Times, serif;
			font-size: 32px;
			color: red;
			margin: -2.15em 1rem .6rem 0;
		}
		p {
			margin-left: .5rem;
		}
		p.agradecimiento {
			font-size: 15px;
			line-height: 1.15em;
			text-indent: 56px;
			margin-top: 0;
			margin-bottom: .7rem;
			margin-right: -5px;
		}
		p.informacion {
			clear:both;
			font-size: 18px;
			margin-bottom: 0;
		}
		.razon-social {
			display: inline-block;
			width: 33.5rem;
			padding-left: .5rem;
			border-bottom: 2px dotted #000;
		}
		.fecha {
			display: inline-block;
			width: 14rem;
			border-bottom: 2px dotted #000;
			text-align: center;
		}
		table {
			border-collapse: separate;
			border-spacing: 2px 0;
			table-layout: fixed;
			width: 100%;
		}
		.cotizacion thead tr th {
			background-color: #c9c9c9;
			border: 1px solid #000;
			border-radius: 9px;
			padding: 0;
			line-height: 1.35em;
			font-weight: bold;
			font-size: 18px;
			text-align: center;
		}
		.cotizacion thead tr th.c-4 {
			letter-spacing: 14px;
		}
		.cotizacion thead tr th.c-6 {
			letter-spacing: 5px;
		}
		.cotizacion thead tr th.c-1 {
			width: 6%;
		}
		.cotizacion thead tr th.c-2 {
			width: 9.5%;
		}
		.cotizacion thead tr th.c-3 {
			width: 7%;
		}
		.cotizacion thead tr th.c-4 {
			width: 54.5%;
		}
		.cotizacion thead tr th.c-5 {
			width: 10%;
		}
		.cotizacion thead tr th.c-6 {
			width: 13%;
		}
		.cotizacion tbody tr td {
			height: 1.55rem;
			border-left: 1px solid #000;
			border-right: 1px solid #000;
			border-bottom: 1px dotted #000;
			text-align: center;
			overflow-x: hidden;
		}
		.cotizacion tbody tr td.d4 {
			padding-left: 6px;
			text-align: unset;
		}
		.cotizacion tbody tr:first-child td {
			border-top: 1px solid #000;
			border-radius: 9px 9px 0 0;
		}
		.cotizacion tbody tr:last-child td {
			border-bottom: 1px solid #000;
			border-radius: 0 0 9px 9px;
		}
		tr.espacio, tr.espacio th {
			height: 1 !important;
			border: 0 !important;
			visibility: hidden;
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
			ADQUISICIONES	
		</div>
		<div class="contactos">
			Teléfono: 4250660 <span style="vertical-align:middle;font-size: 8px;font-family: DejaVu Sans; sans-serif;">&#9679;</span> 4232198 <br>
			Fax: 4231765 <span style="vertical-align:middle;font-size: 8px;font-family: DejaVu Sans; sans-serif;">&#9679;</span> Casilla 992 <br>
			Cochabamba - Bolivia <br>
			4232786 <span style="vertical-align:middle;font-size: 8px;font-family: DejaVu Sans; sans-serif;">&#9679;</span> 4233719 <br>
		</div>
	</div>
	<div style="height:.5rem; clear:both;"></div>
	<div class="titulo">SOLICITUD DE COTIZACIÓN</div>
	<div class="numero">N°<span style="margin-left:-8px;margin-right: 16px;">.</span> {{$cotizacion->codigo_cotizacion}}</div>
	<p class="informacion">
		Razón Social: <span class="razon-social">{{$empresa}}</span> Fecha: <span class="fecha"> {{date("d-m-Y",strtotime($cotizacion->fecha_cotizacion))}} </span>
	</p>
	<p class="agradecimiento">
		Agradecemos a Uds. cotizarnos, los articulos que a continuación se detallan. 
		Luego este formulario debe devolverse en sobre cerrado debidamente FIRMADO Y SELLADO 
		(Favor especificar Marca, Modelo, Industria).
	</p>
	<table class="cotizacion">
		<thead>
			<tr>
				<th class="c-1">N°</th>
				<th class="c-2">Cantidad</th>
				<th class="c-3">Unidad</th>
				<th class="c-4">DETALLE</th>
				<th class="c-5">Unitario</th>
				<th class="c-6">TOTAL</th>
			</tr>
			<tr class="espacio">
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@for($i=0; $i<16; $i++)
			<tr>
				<td>{{$detalles["numero"][$i]}}</td>
				<td>{{$detalles["cantidad"][$i]}}</td>
				<td>{{$detalles["unidad"][$i]}}</td>
				<td class="d4">{{$detalles["detalle"][$i]}}</td>
				<td></td>
				<td></td>
			</tr>
			@endfor
		</tbody>
	</table>
	

</body>
</html>