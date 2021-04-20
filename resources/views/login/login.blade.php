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
    
       <h1>Iniciar Sesión</h1>
           <form  action="/autentificacion" method="POST">
           {{csrf_field()}}
                <label>
                <input name="email" type="email" id="email"  placeholder="Email" value="{{old('email')}}"> 
                </label><br>
                @foreach($errors->get('email') as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach

                <label>
                <input  name="password" type="password" id="Password"  placeholder="Contraseña" value="{{old('password')}}">
                </label><br>
                @foreach($errors->get('password') as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach
                <button type="submit">login</button>

           </form>


    </div>
</body>
</html>