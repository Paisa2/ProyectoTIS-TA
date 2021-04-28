

 @foreach($errors->get('email')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach


                @foreach($errors->get('password')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach




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




 <section class="form-login">
    
              
    
    <h2>Iniciar Sesión</h2>
    <h3>Inicie sesión con su cuenta<h3>
   <form  action="/autentificacion" method="POST">
    {{csrf_field()}}
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-describedby="emailHelp" value="{{ old('email')>
           <div id="emailHelp" class="form-text"></div>
               @foreach($errors->get('email') as $message)
                 <div style="color:red;">{{$message}}<div>
                @endforeach
       </div>
     <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label"></label>
         <input type="password" name="password" class="form-control" id="password" placeholder="contraseña" value="{{ old('password')>>
             @foreach($errors->get('password') as $message)
              <div style="color:red;">{{$message}}<div>
             @endforeach
     </div>

        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
   </form>


</section>



<span class="icon is-small is-right"> 
             <i class="fas fa-envelope"></i>
             </span>




             .mb-3 input{
    height: 50px;
    font-size: 18px;
    padding-left: 50px ;
    

    .submit button{
    
    height: 40px;
    margin:40px auto;
}