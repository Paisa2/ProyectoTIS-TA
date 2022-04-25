@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
  <style>
    @media (min-width: 576px){}
    .modal-dialog {
      max-width: 600px;
    }
    .heads {
      padding-bottom: .5rem;
    }
    .heads ~ div.row {
      padding-bottom: .5rem;
    }
  </style>
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">
  <form action="{{route('usuario.update', $usuario->id)}}" method="post">
    {{csrf_field()}}
    {{method_field('put')}}
    <h2  class="display-4">Registro de Usuario</h2>
    <br>
    <div class="row">
      <div class="mb-3 col-6">
        <label for="nombre" class="form-label">Nombres:</label>
        <input type="text" class="form-control" name="nombres" id="nombre" value="{{old('nombres') ? old('nombres') : $usuario->nombres }}" autocomplete="off">
        @foreach($errors->get('nombres') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>

      <div class="mb-3 col-6">
        <label for="apellido"class="form-label">Apellidos:</label>
        <input type="text" class="form-control" name="apellidos" id="apellido" value="{{old('apellidos') ? old('apellidos') : $usuario->apellidos}}" autocomplete="off">
        @foreach($errors->get('apellidos') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>
    </div>

    <div class="row">   
        
      <div class="mb-3 col-6">
        <label for="CiUsuario" class="form-label">CI:</label>
        <input type="text" class="form-control " name="ci_usuario" id="CiUsuario" autocomplete="off" value="{{old('ci_usuario') ? old('ci_usuario') : $usuario->ci_usuario}}">
        @foreach($errors->get('ci_usuario') as $message) 
        <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
        @endforeach
      </div>

      <div class="mb-3 col-6">
        <label for="TelefonoUsuario" class="form-label">Teléfono:</label>
        <input type="text" class="form-control " name="telefono_usuario" id="TelefonoUsuario" autocomplete="off" value="{{old('telefono_usuario') ? old('telefono_usuario') : $usuario->telefono_usuario}}">
        @foreach($errors->get('telefono_usuario') as $message) 
        <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
        @endforeach
      </div>

    </div>

    <div class="row">     
      <div class="mb-3 col-6">
        <label for="" class="form-label">Pertenece a:</label>
        <select id="unidades" class="form-control" name="unidad_id">
        <option hidden selected value="">Seleccione</option>
    
        @foreach($unidades as $unidad)
        <option {{ old('unidad_id') == $unidad->id || $usuario->unidad_id == $unidad->id ? 'selected' : '' }}  value="{{$unidad->id}}">{{$unidad->nombre_unidad}}</option>
        @endforeach
        </select>
        @foreach($errors->get('unidad_id') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>

      <div class="mb-3 col-6">
        <label class="form-label d-flex align-items-center">Rol: &nbsp;
          <div data-toggle="modal" data-target="#historial" style="cursor:pointer;">
            <svg class="c-icon" data-toggle="tooltip" data-placement="top" title="Historial de roles" viewBox="0 0 32 32">
              <use xlink:href="{{asset('img/icons/history.svg#i-history')}}"></use>
            </svg>
          </div>
        </label>
        <select class="form-control" name="rol_id" id="roles">
        <option hidden selected value="">Seleccione</option>
        @foreach($roles as $rol)
        <option id="{{$rol->nombre_rol}}" {{ old('rol_id') == $rol->id || $usuario->rol_id == $rol->id ? 'selected' : '' }} value="{{$rol->id}}">{{$rol->nombre_rol}}</option>
        @endforeach
        </select>
        @foreach($errors->get('rol_id') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>
    </div>

    <div class="row">
      <div class="mb-3 col-6">
        <label for="emails" class="form-label">Email:</label>
        <input type="text" class="form-control" name="email" id="emails" value="{{old('email') ? old('email') : $usuario->email }}" autocomplete="off">
        @foreach($errors->get('email') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>
    </div>

    <p><span style="font-size:.8em;"> Nota: por seguridad la contraseña no se mostrara, 
    para mantener la contraseña dejar los campos vacios o llenar los campos para cambiar 
    de contraseña.</span></p>
    
    <div class="row">   
      <div class="mb-3 col-6">
        <label for="contrasenias" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" name="contrasenia" id="contrasenias">
        @foreach($errors->get('contrasenia') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>

      <div class="mb-3 col-6">
        <label for="repContrasenia" class="form-label">Confirmar Contraseña:</label>
        <input type="password" class="form-control" name="contrasenia2" id="repContrasenia">
        @foreach($errors->get('contrasenia2') as $message) 
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </div>
    </div>    

    <div class='d-flex justify-content-center'>
			<button type='submit' class="btn btn-primary">REGISTRAR</button>
		</div>
    
    </form>
</div>

<div class="modal fade" id="historial" tabindex="-1" aria-labelledby="presupestoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex kustify-content-center" id="presupestoLabel">Historial de roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row heads">
          <div class="col-1">Nro</div>
          <div class="col-5">Rol</div>
          <div class="col-3">Estado</div>
          <div class="col-3">Fecha</div>
        </div>
        <hr style="margin-top: 0;">
        @foreach($historialRoles as $rol)
          <div class="row">
            <div class="col-1">{{ $loop->index +1 }}</div>
            <div class="col-5">{{ $rol->nombre_rol }}</div>
            <div class="col-3">{{ $rol->estado ? 'Activo' : 'Inactivo' }}</div>
            <div class="col-3">{{ date("Y-m-d",strtotime($rol->created_at)) }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>


<script>
    $("#unidades").on("change", function()
    {
        if($("#unidades").children("option:selected").text().includes("Administrativa")){
            $("#Cotizador").show();
        }
        else{
            $("#Cotizador").hide();
            $("#roles").val("");
        }
    });
</script>

<!-- fin codigo importante -->
@endsection