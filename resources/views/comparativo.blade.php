<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Cotizacion/comparativoCotizaciones.css') }}">
  <style>
    body {
      background-color: #24252F;
      padding: 64px 48px;
    }
  </style>
</head>
<body>

  <div class="titulo d-flex justify-content-center">
    <span>CUADRO COMPARATIVO DE COTIZACIONES</span>
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
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <label class="numero">N° XXXXXX</label>
    </div>
  </div>
  
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
      @for($i=0; $i<16; $i++)
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
  <div class="observaciones mb-3">
    <label for="observaciones" class="form-label">Observaciones: </label>
    <input type="text" id="observaciones" name="observaciones" class="form-control">
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