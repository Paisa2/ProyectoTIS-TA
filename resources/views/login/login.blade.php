<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/217bbe5a21.js" crossorigin="anonymous"></script>
       <!-- Bootstrap CSS -->
      
      
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

     <link  href="{{ asset('css/forms.css') }}"  rel="stylesheet">
     <link  href="{{ asset('css/login.css') }}"  rel="stylesheet">

    <title>Login</title>
</head>
<body>
    
<div id="sesion_cliente">
           
       

    <div class="abs-center">     
    
    
              <form  action="/autentificacion"  class="border p-3 form"     method="POST">
                  {{csrf_field()}}
                 <h2>Iniciar Sesión</h2>
                 <h3>Inicie sesión con su cuenta<h3>
                    <div class="mb-3" >
                            <div class="iconCheck">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <label for="exampleInputEmail1" class="form-label"></label>
                               <input  type="email" name="email" class="form-control" id=" email" placeholder= "Email" aria-describedby="emailHelp" value="{{old('email')}}" autocomplete="off"> 
                                     @foreach($errors->get('email') as $message)
                                      <div class="alert alert-danger" role="alert">{{$message}}</div>
                                     @endforeach
                            
                     </div>
                    <div class="mb-3" id="password-group">
                                <div class="iconCheck">
                                  <i class="fas fa-lock"></i>
                                </div>
     
                           <label for="exampleInputPassword1" class="form-label"></label>
                           <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" value="">
                                      @foreach($errors->get('password') as $message)
                                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                                       @endforeach
                            
                   </div>
                   <div class="submit">
                   <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                   </div>
                                     @foreach($errors->get('password2') as $message)
                                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                                       @endforeach
        
               </form>

   
     </div>

   
</body>
</html>