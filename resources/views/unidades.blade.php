@extends('base')
@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
@if(session()->has('success'))
  <div class="alert alert-success" role="alert" id="success">
    {{ session()->get('success') }}
  </div>
  <script>setTimeout("document.getElementById('success').classList.add('d-none');",3000);</script>
@endif
{{--  @if(session()->has('error'))
  <div class="alert alert-danger" role="alert" id="error">
    {{ session()->get('error') }}
  </div>
  <script>setTimeout("document.getElementById('error').classList.add('d-none');",3000);</script>
@endif  --}}
@if(session()->has('exception'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p>
      {{ session()->get('exception') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </p>
    <hr>
    <p>Nota: Para proteger la integridad de la información y evitar perdida de datos, 
      una Unidad no podra ser eliminado mientras este asignado a un usuario.</p>
  </div>
@endif

@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
<div style="width: 90%; margin:24px auto;" class="container-table">
    <h1 class="display-4">Unidades Registradas</h1>
    @if(session()->has('Crear unidad'))
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('registro.store')}}" class="btn btn-primary">+ Nuevo</a>
    </div>
    @else
    <br><br>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="options">NRO</th>
                <th scope="col">NOMBRE DE UNIDAD</th>
                <th scope="col">TIPO DE UNIDAD</th>
                <th scope="col">PERTENECE A</th>
                <th scope="col">TELEFONO</th>
                <th scope="col">FECHA DE CREACIÓN</th>
                <th class="options"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($unidad as $unidadbd)
        <tr>
            <th scope="row">{{$loop->index +1}}</th>
            <td>{{$unidadbd->nombre_unidad}}</td>
            <td>{{$unidadbd->tipo_unidad}}</td>
            <td>{{$unidadbd->pertenece_a}}</td>
            <td>{{$unidadbd->telefono_unidad}}</td>
            <td>{{date("Y-m-d",strtotime($unidadbd->created_at))}}</td>
            <td class="options">
                <div class="dropdown dropleft">
                    <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="c-icon mfe-2">
                            <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                        </svg>
                    </span>
                    <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                        <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                        @if($unidadbd->presupuesto < 1 && session()->has('Crear presupuesto'))
                        <button class="dropdown-item" data-toggle="modal" data-target="#presupuesto" data-value="{{$unidadbd->id}}">
                            <svg class="c-icon mfe-2">
                                <use xlink:href="{{asset('img/icons/plus.svg#i-plus')}}"></use>
                            </svg>Presupuesto
                        </button>
                        @endif
                        @if(session()->has('Editar unidad'))
                                <a class="dropdown-item" href="{{route('registro.edit', $unidadbd->id)}}">
                                  <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('img/icons/edit.svg#i-edit')}}"></use>
                                    </svg>Editar
                                </a>
                        @endif
                        @if($unidadbd->sub_unidades == 0 && session()->has('Eliminar unidad'))
                        <form action="{{ route('registro.destroy', $unidadbd->id) }}" method="post" class="d-none" id="delete{{$loop->index +1}}">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                <button class="dropdown-item" type="submit" form="delete{{$loop->index +1}}">
                                <svg class="c-icon mfe-2">
                                <use xlink:href="{{asset('img/icons/trash.svg#i-trash')}}"></use>
                                </svg>Eliminar
                                </button>
                        @endif
                    </div>
                </div>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
    {{--  {!!$unidad->render()!!}  --}}
    </div>

    @if(session()->has('Crear presupuesto'))
    <div class="modal fade" id="presupuesto" tabindex="-1" aria-labelledby="presupestoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex kustify-content-center" id="presupestoLabel">Asignar Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('presupuestos.store') }}" method="post" id="asignar-form">
                        {{ csrf_field() }}
                        <input type="text" name="unidad_id" class="d-none form-control" id="unidad_id">
                        <label for="">Este presupuesto sera asignado para la gestion {{Date('Y')}}</label>
                        <div>
                            <label class="form-label" for="monto">Monto:</label>
                            <input type="text" name="monto" id="monto" class="form-control">
                        </div>
                    </form>
                    <div class="alert alert-danger d-none" role="alert" id="required-m">El campo monto es requerido</div>
                    <div class="alert alert-danger d-none" role="alert" id="numeric-m">El campo debe ser numerico</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="asignar" form="asignar-form">Asignar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('scripts')
<script src="{{ asset('js/unidades/visualizarUnidades.js') }}"></script>
@endsection