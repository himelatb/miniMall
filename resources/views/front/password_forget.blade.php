<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>miniMall|Forget Password?</title>
    <link rel="stylesheet" href="{{url('front/css/login-register.css')}}" />
  </head>
  <body>
    <section class="wrapper">
      <div class="form">
        <header>Forgot Password?</header>
        @if ($errors->has('email'))
            <small class="error" style="color: red;">{{ $errors->first('email') }}</small>
        @endif
        @if(isset($_COOKIE["message"])) 
        <strong class="msg" style="color: rgb(11, 90, 1);">{{ $_COOKIE["message"] }}</strong>
          @endif
        <form action="{{url('/password_forget')}}" method="POST" class="email" id="email">@csrf
          <input type="text" placeholder="Email address" name="email" id="email" @if(isset($_COOKIE["email"])) 
          value="{{ $_COOKIE["email"] }}" @endif required />
          <input type="submit" {{isset($_COOKIE["message"])? 'disabled hidden': ''}} value="Submit" />
        </form>
      </div>
    </section>
  </body>
</html>
