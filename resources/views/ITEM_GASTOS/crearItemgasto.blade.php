<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Items de Gasto</title>
  </head>
  <body>
    <div class="container my-4">
       <h1 class="display-4">
        Registro de item de gasto
       </h1>
       <form method="post" action="/itemsgastos">
       {{csrf_field()}}
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tipo:</label>
    <br>
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
  <input type="radio" class="btn-check" name="tipo_item" id="btnradio1" autocomplete="off" checked>
  <label class="btn btn-outline-primary" for="btnradio1">Generico</label>

  <input type="radio" class="btn-check" name="tipo_item" id="btnradio2" autocomplete="off">
  <label class="btn btn-outline-primary" for="btnradio2">Especifico</label>
</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nombre:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="nombre_item">
  </div>
  <div class="mb-3">
      <label for="disabledSelect" class="form-label">Pertenece a:</label>
      <select id="disabledSelect" class="form-select" name="item_id">
        <option>Seleeccione</option>
      </select>
  </div>
  <button type="submit" class="btn btn-primary">REGISTRAR</button>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>