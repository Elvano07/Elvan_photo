<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Photos</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href='{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href='{{ asset('plugins/adminlte/css/AdminLTE.min.css') }}'>
    <link rel="stylesheet" href='{{ asset('css/login.css') }}'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class='login-bg'></div>
<div class="login-box">
  <div class="login-logo">
    <a href=""><img src='{{ asset('img/BankPhotos.png') }}' width='30%'></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('signin') }}" method="post">
      @if ($errors->login->first('notfound'))
        <div class='alert alert-danger' id='warning-notfound'>
          <button type="button" class="close" onclick="$('#warning-notfound').addClass('hide')">×</button>
          {{ $errors->login->first('notfound') }}
        </div>
      @endif
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email or Username..." maxlength='254' name='email' value="{{ old('email') }}">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      @if ($errors->login->first('email'))
        <div class='alert alert-warning' id='warning-email'>
          <button type="button" class="close" onclick="$('#warning-email').addClass('hide')">×</button>
          {{ $errors->login->first('email') }}
        </div>
      @endif
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password..." maxlength='32' name='password'>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      @if ($errors->login->first('password'))
        <div class='alert alert-warning' id='warning-password'>
          <button type="button" class="close" onclick="$('#warning-password').addClass('hide')">×</button>
          {{ $errors->login->first('password') }} 
        </div>
      @endif
      {!! csrf_field() !!}
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div> 
      <br>
      <p><a href='{{ route('signup') }}'>Don't have an account? Sign Up.</a></p>
    </form>

    <hr>
    <p class='text-center'>Copyright &copy; 2017 Bank Photos, <br> All Right Reserved.</p>
  </div>
</div>

</body>
</html>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>