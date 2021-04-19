<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    
    <div class="navbar">
    
       <h1>Iniciar Seción</h1>
           <form  action="Bienvenido.html" method="POST">
           {{csrf_field()}}
                <label>
                <input name="email" type="email" id="email"  placeholder="Email" value="{{old('email')}}"> 
                @foreach($errors->get('email')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach
                </label><br>
               

                <label>
                <input  name="password" type="password" id="Password"  placeholder="Contraseña" value="{{old('password')}}">
                @foreach($errors->get('password')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach
                </label><br>
                
                <button type="submit">login</button>

           </form>


    </div>
</body>
</html>