<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="{{ asset('css/login.css') }}"  rel="stylesheet">
       <!-- Bootstrap CSS -->
      
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    

<div class="container">    
 <div class="abs-center">     
    
    
   <form  action="/autentificacion"  class="border p-3 form"     method="POST">
    {{csrf_field()}}
    <h2>Iniciar Sesión</h2>
    <h3>Inicie sesión con su cuenta<h3>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-describedby="emailHelp">
           <div id="emailHelp" class="form-text"></div>
               @foreach($errors->get('email') as $message)
                 <div style="color:red;">{{$message}}<div>
                @endforeach
       </div>
     <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label"></label>
         <input type="password" name="password" class="form-control" id="password" placeholder="contraseña">
             @foreach($errors->get('password') as $message)
              <div style="color:red;">{{$message}}<div>
             @endforeach
     </div>
        
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        
   </form>

   </div>
</div>

   
</body>
</html>