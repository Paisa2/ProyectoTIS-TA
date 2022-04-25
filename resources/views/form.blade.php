<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
  <style>
    body {
      background-color: #24252F;
      padding: 48px;
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
            <td></td>
            <td></td>
						<!-- <td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]"></td> -->
          </tr>
        @endfor
      </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

  
</body>
</html>