<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bank Photos</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href='{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    @yield('content')
    <hr>
    <p class='text-center'>Copyright &copy; 2017 Bank Photos, <br> All Right Reserved.</p>
  </div>
</div>

</body>
</html>
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
@yield('js')