<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <style>
		body {
			background-color: #24252F;
			padding: 48px;
		}
		table {
			border-collapse: separate;
			border-spacing: 2px 0;
			table-layout: fixed;
			width: 100%;
			color: #fff;
		}
		.cotizacion thead tr th {
			border: 1px solid #fff;
			border-radius: 5px;
			font-weight: normal;
			text-align: center;
		}
		.cotizacion thead tr th.c-4, .cotizacion thead tr th.c-6 {
			letter-spacing: 4px;
		}
		.cotizacion thead tr th.c-1 {
			width: 6%;
		}
		.cotizacion thead tr th.c-2 {
			width: 10%;
		}
		.cotizacion thead tr th.c-3 {
			width: 8%;
		}
		.cotizacion thead tr th.c-4 {
			width: 54%;
		}
		.cotizacion thead tr th.c-5 {
			width: 10%;
		}
		.cotizacion thead tr th.c-6 {
			width: 12%;
		}
		.cotizacion tbody:before {
			content: "";
			display: block;
			height: 4px;
			color: transparent;
		}
		.cotizacion tbody tr td {
      padding: 0;
    }
    .cotizacion tbody tr td input {
      width: 100%;
      background-color: transparent;
      color: #fff;
			border-left: 1px solid #fff;
			border-right: 1px solid #fff;
			border-bottom: 1px dotted #fff;
      border-top: 0;
			text-align: center;
			overflow-x: hidden;
		}
		.cotizacion tbody tr td.d4 input{
      padding-left: 8px;
			text-align: unset;
		}
		.cotizacion tbody tr:first-child td input{
			border-top: 1px solid #fff;
			border-radius: 5px 5px 0 0;
		}
		.cotizacion tbody tr:last-child td input{
			border-bottom: 1px solid #fff;
			border-radius: 0 0 5px 5px;
		}
	</style>
</head>
<body>

  <form action="{{route('datos')}}" method="post">
    {{csrf_field()}}
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
      </thead>
      <tbody>
        @for($i=0; $i<16; $i++)
          <tr>
            <td><input type="number" min="1" max="16" name="detalles[numero][n{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[cantidad][c{{$i}}]"></td>
            <td><input type="text" name="detalles[unidad][ud{{$i}}]"></td>
            <td class="d4"><input type="text" name="detalles[detalle][d{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]"></td>
          </tr>
        @endfor
      </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

  
</body>
</html>