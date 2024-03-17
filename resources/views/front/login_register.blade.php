<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>miniMall|Login</title>
    <link rel="stylesheet" href="{{url('front/css/login-register.css')}}" />
  </head>
  <body>
    <section class="wrapper userLoginPage {{$login == true? 'active': ''}}">
      <div class="form signup">
        <header>Signup</header>
        <form action="{{url('/register')}}" method="POST" class="signupFrom" id="signupFrom">@csrf
          @if($errors->has('name'))
              <small class="error" style="color: red;">{{ $errors->first('name') }}</small>
          @endif
          <input type="text" name="name" id="name" placeholder="Full name" value="{{isset($data['name']) ? $data['name']: ""}}" required />
          @if($errors->has('email'))
              <small class="error" style="color: red;">{{ $errors->first('email') }}</small>
          @endif
          <input type="text" name="email" id="email" placeholder="Email address" value="{{isset($data['email'])? $data['email']: ""}}" required />

          <input type="password" name="password" id="password" placeholder="Password" value="{{isset($data['password'])? $data['password']: ""}}" required />
          @if($errors->has('password'))
              <small class="error" style="color: red;">{{ $errors->first('password') }}</small>
          @endif
          <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" value="{{isset($data['password_confrimation'])? $data['password_confrimation']: ""}}" required />
          
          @if($errors->has('terms'))
            <small class="error" style="color: red;">{{ $errors->first('terms') }}</small>
          @endif
          <div class="checkbox">
            <input type="checkbox" id="terms" name="terms"/>
            <label for="terms" style="color: rgba(0, 0, 0, 0.616);">I accept all terms & conditions</label>
          </div>
          <input type="submit" value="Signup" />
        </form>
      </div>

      <div class="form login">
        <header>Login</header>
        @if (isset($error))
            <small class="error" style="color: red;">{{$error}}</small>
        @endif
        <form action="{{url('/login')}}" method="POST" class="signinFrom" id="signinFrom">@csrf
          <input type="text" placeholder="Email address" name="email" id="email" @if(isset($_COOKIE["email"])) 
          value="{{ $_COOKIE["email"] }}" @endif required />
          <input type="password" placeholder="Password" name="password" id="password" @if(isset($_COOKIE["password"])) 
          value="{{ $_COOKIE["password"] }}" @endif required />
          <div class="checkbox">
            <input type="checkbox" id="remember" @if(isset($_COOKIE["email"])) 
            checked @endif name="remember">
            <label for="remember" style="color: rgba(0, 0, 0, 0.616);"> Remember Me</label>
            <a href="{{url('/password_forget')}}" style="margin-left:auto">Forgot password?</a>
          </div>
          <input type="submit" value="Login" />
        </form>
      </div>

      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
          document.querySelectorAll(".error").forEach(el => el.remove());
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
          document.querySelectorAll(".error").forEach(el => el.remove());
        });
      </script>
    </section>
  </body>
</html>
