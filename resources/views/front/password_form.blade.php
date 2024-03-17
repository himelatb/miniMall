<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>miniMall|Reset Password</title>
    <link rel="stylesheet" href="{{url('front/css/login-register.css')}}" />
  </head>
  <body>
    <section class="wrapper">
      <div class="form password">
        <header>Reset Password</header>
        <form method="POST" class="set_password" id="set_password" sandbox="allow-scripts allow-forms">@csrf
          @if($errors->has('password'))
          <small class="error" style="color: red;">{{ $errors->first('password') }}</small>
        @endif
        <input type="text" name="token" id="token" value="{{$token}}" hidden>
        <input type="password" name="password" id="password" placeholder="New Password" required />
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" value="{{isset($data['password_confrimation'])? $data['password_confrimation']: ""}}" required />
        <input type="submit" value="Submit" />
        </form>
      </div>
    </section>
  </body>
</html>
