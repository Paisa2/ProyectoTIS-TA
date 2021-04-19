

 @foreach($errors->get('email')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach


                @foreach($errors->get('password')as $message)
                <div style="color:red;">{{$message}}<div>
                @endforeach