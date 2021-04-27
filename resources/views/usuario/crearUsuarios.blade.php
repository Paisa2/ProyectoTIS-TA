<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

<!-- codigo importante -->

<div class="container my-4">

<h2>Crear Usuario</h2>
<br>
    <form action="/usuario" method="post">
        {{csrf_field()}}

        <div>
            <label for="nombre" class="form-label">Nombres:</label>
            <input type="text" class="form-control" name="nombres" id="nombre" value="{{old('nombres')}}">
            @foreach($errors->get('nombres') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
            <div></div>
        </div>

        <div>
            <label for="apellido">Apellidos:</label>
            <input type="text" class="form-control" name="apellidos" id="apellido" value="{{old('apellidos')}}">
            @foreach($errors->get('apellidos') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div>
            <label for="">Rol:</label>
            <select class="form-control" name="rol_id" id="">
            @foreach($roles as $rol)
            <option value="{{$rol->id}}">{{$rol->nombre_rol}}</option>
            @endforeach
            </select>
            @foreach($errors->get('rol_id') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div>
            <label for="emails">Email:</label>
            <input type="text" class="form-control" name="email" id="emails" value="{{old('email')}}">
            @foreach($errors->get('email') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div>
            <label for="">Pertenece a:</label>
            <select class="form-control" name="unidad_id" id="">
           
            @foreach($unidades as $unidad)
            <option value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
            @endforeach
            </select>
            @foreach($errors->get('unidad_id') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div>
            <label for="contrasenias">Contraseña:</label>
            <input type="password" class="form-control" name="contrasenia" id="contrasenias">
            @foreach($errors->get('contrasenia') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div>
            <label for="repContrasenia">Confirmar Contraseña:</label>
            <input type="password" class="form-control" name="contrasenia2" id="repContrasenia">
            @foreach($errors->get('contrasenia2') as $message) 
            <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
        </div>

        <div style="width:600px;">
            <div style="display:flex;justify-content:space-between;width:auto;">
                <div>Modulo</div>
                <div>Visualizar</div>
                <div>Crear</div>
                <div>Editar</div>
            </div>
            <div style="display:flex;justify-content:space-between;width:auto;">
            <div>Unidades</div>
                <input type="checkbox" name="permisos[]" value="1">
                <input type="checkbox" name="permisos[]" value="2">
                <input type="checkbox" name="permisos[]" value="3">
            </div>

            <div style="display:flex;justify-content:space-between;width:auto;">
            <div>Roles</div>
                <input type="checkbox" name="permisos[]" value="1">
                <input type="checkbox" name="permisos[]" value="2">
                <input type="checkbox" name="permisos[]" value="3">
            </div>

            <div style="display:flex;justify-content:space-between;width:auto;">
            <div>Usuarios</div>
                <input type="checkbox" name="permisos[]" value="1">
                <input type="checkbox" name="permisos[]" value="2">
                <input type="checkbox" name="permisos[]" value="3">
            </div>

        </div>

        <div class='botons-group'>
			<input type='submit' class="btn btn-primary" name='volver' value = 'REGISTRAR'>
		</div>

    </form>

</br>

</div>



<!-- fin codigo importante -->

</body>
</html>
