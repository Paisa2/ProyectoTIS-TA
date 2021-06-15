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
                <form action="" method="get">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                      Todos
                    </button>
                    <ul class="dropdown-menu show" aria-labelledby="dropdownMenu2">
                        <li><button class="dropdown-item" type="submit" name="todos" id="todos">Todos</button></li>
                        <input type="hidden" name="rubro" value="todos">
                    @foreach ($registros as $select)
                    <li><button class="dropdown-item" type="submit" name="rubro" id="rubro">{{$select->rubro_empresa}}</button></li>
                    @endforeach
                    <input type="hidden" name="rubro" value={{$registros}}>
                    </ul>
                  </div>
                </form>
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
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                    <tr>
                        <td scope="row">{{ $loop->index +1}}</td>
                        <td>{{$registro->nombre_empresa}}</td>
                        <td>{{$registro->rubro_empresa}}</td>
                        <td>{{$registro->representante_legal}}</td>
                        <td class="c-dark-theme options">
                            <div class="dropdown dropleft">
                              <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg class="c-icon mfe-2">
                                  <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                                </svg>
                              </span>
                              <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                                <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                                <a class="dropdown-item" href="{{ route('empresa.show')}}">
                                  <svg class="c-icon mfe-2">
                                    <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                                </svg>Detalles
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