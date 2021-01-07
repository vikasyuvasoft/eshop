<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body">
<div class="login-logo">
    <a href="{{ asset('public/admin/index2.html') }}"><b>Admin Login</b></a>
  </div>
  @if(session('result'))
  <div class="alert {{ session('result') }}">
  {{session('message')}}
</div>
  @endif
      <form  class="mt-5" action="{{ url('SubmitLoginData') }}" method="post" id="AdminLoginForm">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>       
        </div>
     @if($errors->has('email'))  <p style="color:red;"> {{ $errors->first('email') }}  @endif</p>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          @if($errors->has('password'))  <p style="color:red;"> {{ $errors->first('password') }}  @endif</p>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-block" value="Sign In">
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
