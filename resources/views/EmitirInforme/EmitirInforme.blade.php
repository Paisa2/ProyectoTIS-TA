@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/EmitirInforme.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
@section('main')
<div class="container ">
        
    <form>
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs">
               <li class="nav-item">
                <a class="nav-link " href="#">CARTA CON FORMATO</a>
               </li>
               <li class="nav-item">
                <a class="nav-link" href="#">CARTA SIN FORMATO</a>
               </li>
 
             </ul>
              <div>
                  <br>
                  <br>
                 <h3>DETALLE DE LA SOLICITUD DE ADQUISICIÓN</h3>
                 <br>
              </div>
               <!--  inicio de Acordion--->
              <div class="accordion" id="accordionExample">
                    <div class="card">
                       <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              DETALLE
                             </button>
                          </h2>
                       </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                         <div class="card-body">
                           Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                          </div>
                       </div>
                    </div>

                    <div class="card">
                           <div class="card-header" id="headingTwo">
                               <h2 class="mb-0">
                                   <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                       ADJUNTOS
                                    </button>
                                </h2>
                            </div>
                           <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                               <div class="card-body">
                                 Some placeholder content for the second accordion panel. This panel is hidden by default.
                               </div>
                           </div>
                   </div>
 
                </div>
                <!--  fin de Acordion--->

                 <div class="panel-group" id="accordion" role="tablist">
                     <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading1">
                          <h4 class="panel-title">
                              <a href="#collapse1" data-toggle="collapse" data.parent="accordion">
                                Encabezado #1
                               </a>
                            </h4>
                        </div>
                          <div id="collapse1" class="panel-collapse collapse in ">
                            <div class="panel-body">
                             lorem hola como esta a qui esta todo el detalle de la solicitud
                            </div>
                         </div>
                     </div>
                 </div>

                 <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo. Sed feugiat egestas nisl sed faucibus. Fusce nisi metus, accumsan eget ullamcorper eget, iaculis id augue. Vivamus porta elit id nulla varius, in sodales massa bibendum. Nullam condimentum pellentesque est, vel lacinia ipsum efficitur sed. Morbi porttitor porta commodo.
      </div>
    </div>
  </div>
</div>


            </div>
         </div>
    </form>
  </div>
 
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection