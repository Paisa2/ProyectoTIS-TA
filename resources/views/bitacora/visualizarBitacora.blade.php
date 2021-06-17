@extends('base')

@section('head')
@endsection

@section('main')
  
<!-- codigo importante -->

<div class="container-pane d-flex flex-column" style="width:95%;">

  <h1 class="display-5 text-left">Bitacora de Actividades de Usuario</h1>
  <br>
  <div class="table-responsive-lg">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:1.5rem;"></th>
          <th style="width:15%;">Usuario</th>
          <th style="width:15%;">Fecha</th>
          <th style="width:15%;">Operacion</th>
          <th style="width:calc(55% - 1.5rem);">Detalle</th>
        </tr>
      </thead>
      <tbody>
        @foreach($bitacoras as $bitacora)
        <tr>
          <td scope="row">{{ $loop->index + 1}}</td>
          <td>{{ $bitacora->nombre_usuario }}</td>
          <td>{{ date("Y-m-d", strtotime($bitacora->created_at))}}</td>
          <td>{{ $bitacora->operacion }}</td>
          <td>{{ $bitacora->detalle_bitacora }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <nav class="mt-auto" aria-label="Page navigation">
    <ul class="pagination m-0">
      @if($bitacoras->previousPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$bitacoras->previousPageUrl()}}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      @endif
      @if($bitacoras->previousPageUrl())
      <li class="page-item"><a class="page-link" href="{{$bitacoras->previousPageUrl()}}">{{$bitacoras->currentPage()-1}}</a></li>
      @endif
      <li class="page-item active"><a class="page-link" href="#">{{$bitacoras->currentPage()}}</a></li>
      @if($bitacoras->nextPageUrl())
      <li class="page-item"><a class="page-link" href="{{$bitacoras->nextPageUrl()}}">{{$bitacoras->currentPage()+1}}</a></li>
      @endif
      @if($bitacoras->nextPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$bitacoras->nextPageUrl()}}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      @endif
    </ul>
  </nav>

</div>

<!-- fin codigo importante -->

@endsection