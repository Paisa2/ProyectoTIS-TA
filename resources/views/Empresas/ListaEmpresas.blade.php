@extends('base')
@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
@endsection

@section('main')
@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
    <div style="width: 90%; margin:24px auto;" class="container-table">
        <div><h1 class="display-4">Empresas Registradas</h1></div>
        <div class="row g-2">
            <div class="col-md">
              <div class="d-flex justify-content-first mb-3">
              <form action="" method="GET">
                {{-- <nav class="navbar navbar-light float-left">
                  <div class="container-fluid">
                    <form class="d-flex">
                      <input name="rubro" class="form-control me-2" type="search" aria-label="Search" autocomplete="off">
                      <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                  </div>
                </nav> --}}
              <div class="dropdown">
                <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{$tipo1==''?'Todos':$tipo1}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <span class="options">
                    <button class="dropdown-item" type="submit" name="rubro" value="" id="rubro">Todos</button>
                    @foreach($registros as $rubros)
                    <button class="dropdown-item" type="submit" name="rubro" value="{{$rubros->rubro_empresa}}" id="rubro">{{$rubros->rubro_empresa}}</button>
                    @endforeach
                  </span>
                  <span class="without d-none">Sin resultados</span>
                </div>
              </div>
             </form>
            </div>
            </div>
            <div class="col-md">
            <div class="d-flex justify-content-end mb-3">
              <a href="{{route('empresa.create')}}" class="btn btn-primary">+ Nuevo</a>
            </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NRO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">RUBRO</th>
                    <th scope="col">REPRESENTANTE LEGAL</th>
                    <th scope="col">TELEFONO</th>
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tabla as $registro)
                    <tr>
                        <td scope="row">{{ $loop->index +1}}</td>
                        <td>{{$registro->nombre_empresa}}</td>
                        <td>{{$registro->rubro_empresa}}</td>
                        <td>{{$registro->representante_legal}}</td>
                        <td>{{$registro->telefono_empresa}}</td>
                        <td class="options">
                            <div class="dropdown dropleft">
                              <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="c-icon mfe-2">
                                  <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                                </svg>
                              </span>
                              <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                                <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                                <a class="dropdown-item" href="{{route('empresa.show', $registro->id)}}">
                                  <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                                </svg>Detalles
                                </a>
                                
                                    <form action="{{ route('empresa.destroy', $registro->id) }}" method="post" class="d-none" id="delete{{$loop->index +1}}">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                    <button class="dropdown-item" type="submit" form="delete{{$loop->index +1}}">
                                    <svg class="c-icon mfe-2">
                                        <use xlink:href="{{asset('img/icons/trash.svg#i-trash')}}"></use>
                                    </svg>Eliminar
                                    </button>

                                    <a class="dropdown-item" href="{{route('empresa.edit', $registro->id)}}">
                                      <svg class="c-icon mfe-2">
                                        <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                                    </svg>Editar
                                    </a>
                                       
                              </div>
                            </div>
                          </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection