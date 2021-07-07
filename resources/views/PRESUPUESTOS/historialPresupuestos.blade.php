@extends('base')

@section('head')
@endsection

@section('main')
  
<!-- codigo importante -->

<div class="container-pane d-flex flex-column" style="width:95%;">

  <h1 class="display-5 text-left">Historal de Presupuestos</h1>
  <br>
  <div class="table-responsive-lg">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width:1.5rem;"></th>
          <th>Unidad</th>
          <th>Monto Asignado</th>
          <th>Monto Sobrante</th>
          <th>Gestion</th>
          <th>Estado</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        @foreach($historiales as $historial)
        <tr>
          <td scope="row">{{ $loop->index + 1}}</td>
          <td>{{ $historial->nombre_unidad }}</td>
          <td>{{ $historial->monto}}</td>
          <td>{{ $historial->monto_disponible }}</td>
          <td>{{ $historial->gestion }}</td>
          <td>{{ $historial->estado? 'Activo':'Inactivo' }}</td>
          <td>{{ date("d-m-Y", strtotime($historial->created_at))}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
  <nav class="mt-auto" aria-label="Page navigation">
    <ul class="pagination m-0">
      @if($historiales->previousPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$historiales->previousPageUrl()}}" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      @endif
      @if($historiales->previousPageUrl())
      <li class="page-item"><a class="page-link" href="{{$historiales->previousPageUrl()}}">{{$historiales->currentPage()-1}}</a></li>
      @endif
      <li class="page-item active"><a class="page-link" href="#">{{$historiales->currentPage()}}</a></li>
      @if($historiales->nextPageUrl())
      <li class="page-item"><a class="page-link" href="{{$historiales->nextPageUrl()}}">{{$historiales->currentPage()+1}}</a></li>
      @endif
      @if($historiales->nextPageUrl())
      <li class="page-item">
        <a class="page-link" href="{{$historiales->nextPageUrl()}}" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      @endif
    </ul>
  </nav>

</div>

<!-- fin codigo importante -->

@endsection