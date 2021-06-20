<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/217bbe5a21.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link  href="{{ asset('css/base2.css') }}"  rel="stylesheet">
    <link  href="{{ asset('css/forms.css') }}"  rel="stylesheet">
    <link  href="{{ asset('css/login.css') }}"  rel="stylesheet">
    <link  href="{{ asset('css/contacto.css') }}"  rel="stylesheet">
    <title>CotySoft</title>
  </head>
<body class="c-dark-theme">

<nav class= "nav d-flex justify-content-end" id="navbar">
            
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" id="informacion" href="#informacion">Acerca de Sistema</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contacto" href="#contacto">Contactos</a>
    </li>
    <li class="nav-item">
    <a class="nav-link " id="soporte" href="#soporte">Soporte</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="login" href="#login">Inicio Sesión</a>
    </li>
  </ul>

</nav>

<div class="container pane" id="p-informacion" style="display:none;">
  <div class='row'>
    <div class='col-6'>

      <div class='user-img'>
      <img src="/imagenes/informacion.jpg"> 
      </div>
    </div>

    <div class='col-6'>
      <h2> Sistema de Información</h2>
      <br>
      <p _ngcontent-sjr-c70 class="textP">
      “Queremos asesorarle de principio a fin ayudándole a cotizar de manera 
      transparente e instantánea el sistema de información web que requiere tu institución"
      </p>
      <p _ngcontent-sjr-c70 class="textP">
      COTYSOFT Es una aplicación desarrollada por la empresa TechnoAvance 
      con el finalidad de ayudar al personal admisitrativo de la Universidad Mayor de San Simón en la
      gestion del proceso de cotización de un bien o servicio.
      </p>
      <p _ngcontent-sjr-c70 class="textP">
      Accede a los cuadros comparativos de la cotizacion para mejorar la toma de deciciones 
      con la ayuda de sugerencias que proporsiona la aplicación web.
      </p>
      <p _ngcontent-sjr-c70 class="textP">
      Genera reportes y accede a ellos cuando sea necesario para el control y administración de 
      actividad de una unidad facultativa durante una gestión
      </p>
    </div>

  </div>
</div>

<div class="container pane" id="p-login" style="display:none;">
    <div class="abs-center">     
      <form  action="/autentificacion"  class="border p-3 form"     method="POST">
        {{csrf_field()}}
        <div id="logo">
          <img src="{{ asset('imagenes/cotysoft.png') }}" alt="cotysoft">
        </div>
        <h2>Iniciar Sesión</h2>
        <h3>Ingrese los datos de su cuenta<h3>
        <div class="mb-3" >
          <div class="iconCheck"><i class="fas fa-envelope"></i></div>
          <label for="exampleInputEmail1" class="form-label"></label>
          <input  type="text" name="email" class="form-control" id=" email" placeholder= "Email" aria-describedby="emailHelp" value="{{old('email')}}" autocomplete="off"> 
          @foreach($errors->get('email') as $message)
          <div class="alert alert-danger" role="alert">{{$message}}</div>
          @endforeach
        </div>
        <div class="mb-3" id="password-group">
          <div class="iconCheck"><i class="fas fa-lock"></i></div>
          <label for="exampleInputPassword1" class="form-label"></label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="">
          @foreach($errors->get('password') as $message)
          <div class="alert alert-danger" role="alert">{{$message}}</div>
          @endforeach
        </div>
        <div class="submit {{ $errors->has('password') || $errors->has('password2') ? 'error' : '' }}" id="iniciar-sesion">
          <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </div>
        @foreach($errors->get('password2') as $message)
        <div class="alert alert-danger" role="alert">{{$message}}</div>
        @endforeach
      </form>
    </div>
</div>

<div class="container pane" id="p-contacto" style="display:none;">
  <div class='row'>
    <div class='col-6'>

      <h2>Contactos</h2>
      <h4>Relaciones Publicas</h4>

      <div style="display: flex; padding: 0px 15px 0px 15px;">
        <div class="iconCheck"><i class="fas fa-envelope"></i></div> 
        <label class='alin'>rr.pp@umss.edu.bo</label>
      </div> 

      <div style="display: flex; padding: 0px 15px 0px 15px;">
        <i class="fas fa-phone-alt"></i>
        <label class='alin'>(+591)4 4251515; (+591)4 4525161</label>
      </div> 

      <div style="display: flex; padding: 0px 15px 0px 15px;">
        <i class="fas fa-fax"></i>
        <label class='alin'>(+591)4 4525161</label>
      </div> 
      <h4>Secretaria General</h4>

      <div style="display: flex;  padding: 0px 15px 0px 15px;">
        <div class="iconCheck"><i class="fas fa-envelope"></i></div> 
        <label class='alin'>s.gral@gmail.umss.edu.bo</label>
      </div> 

      <div style="display: flex; padding: 0px 15px 0px 15px;">
        <i class="fas fa-phone-alt"></i>
        <label class='alin'> (+591)4 4525161</label>
      </div> 

      <div style="display: flex;  padding: 0px 15px 0px 15px;">
        <i class="fas fa-fax"></i>
        <label class='alin'>(+591)4 4524772</label>
      </div> 
      <h4>Información General</h4>

      <div style="display: flex; padding: 0px 15px 0px 15px;">
        <div class="iconCheck"><i class="fas fa-envelope"></i></div> 
        <label class='alin'>información@umss.edu.bo</label>
      </div> 
      <h4>Dirección</h4>
      <div style="display: flex; padding: 0px 15px 0px 15px;">    
        <i class="fas fa-route"></i>
        <label class='alin'> Campus Central: Av.Oquendo final Jordan, Cochabamba Bolivia </label>
      </div>

    </div>

    <div class='col-6'>
      <div class='user-img'>
        <img src="/imagenes/contactos.jpg"> 
      </div>
    </div>

  </div>

</div>

<div class="container pane" id="p-soporte" style="display:none;">
  <div class='row'>
    <div class='col-6'>
      <h2>Soporte</h2>
      <br>
      <h2>Ayuda</h2>
      <h4>¿No recuerda su cuenta para iniciar sesión?</h4>
      <p _ngcontent-sjr-c70 class="textP">
      En caso de olvidar la información requerida para iniciar Sesión 
      el usuario debe solicitar al encargado del sistema sus credenciales
      para poder ingresar al sistema.
      </p>

      <h4>¿ Tiene Fallas de Sistema?</h4>
      <p _ngcontent-sjr-c70 class="textP">
      En caso de presentar fallas en el sistema contactar con la empresa responsable
      </p>
      <div class='row'>
        <div class='col-6'>
          <div class='user-imagen'>
            <img src="/imagenes/TecnoAvance.PNG"> 
          </div>
        </div>
        <div class='col-6'>
          <div style="display: flex;  padding: 0px 15px 0px 15px;">

            <div class="iconCheck"><i class="fas fa-envelope"></i></div> 
            <label class='alin'>tecnoavance.21@gmail.com</label>
          </div> 

          <div style="display: flex; padding: 0px 15px 0px 15px;">

            <i class="fas fa-phone-alt"></i>
            <label class='alin'> (+591)4 4525161</label>
          </div> 
          <div style="display: flex; padding: 0px 15px 0px 15px;">

            <i class="fas fa-route"></i>
            <label class='alin'> Av. Republica y Punata, Cochabamba-Bolivia </label>
          </div> 
        </div>
      </div>

    </div>

    <div class='col-6'>
      <br>
      <br>

      <div class='user-img'>
        <img src="/imagenes/soporte.jpg"> 
      </div>
    </div>

  </div>
</div>

<script>
  $(window).on("load", function() {

    $("#login").on("click", function() {
      $(".pane").hide();
      $("#p-login").show();
      $(".nav-link").removeClass("active");
      $("#login").addClass("active");
    });
    $("#contacto").on("click", function() {
      $(".pane").hide();
      $("#p-contacto").show();
      $(".nav-link").removeClass("active");
      $("#contacto").addClass("active");
    });
    $("#informacion").on("click", function() {
      $(".pane").hide();
      $("#p-informacion").show();
      $(".nav-link").removeClass("active");
      $("#informacion").addClass("active");
    });
    $("#soporte").on("click", function() {
      $(".pane").hide();
      $("#p-soporte").show();
      $(".nav-link").removeClass("active");
      $("#soporte").addClass("active");
    });
    if(location.hash){
      $(location.hash).trigger("click");
    }else if($("#iniciar-sesion").hasClass("error")) {
      $("#login").trigger("click");
    }else {
      $("#informacion").trigger("click");
    }

  });
</script>

</body>
</html>