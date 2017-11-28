
<!DOCTYPE html>
<html>
<head>
  <!-- <script>
  document.addEventListener('contextmenu', event => event.preventDefault());
  </script> -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bank Photos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{ asset('plugins/swal/sweetalert.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('plugins/adminlte/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('plugins/adminlte/css/skins/_all-skins.min.css') }}">

  <!-- jQuery 2.2.3 -->
  <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

  <style>
  .hovereffect {
  width:100%;
  height:100%;
  float:left;
  overflow:hidden;
  position:relative;
  text-align:center;
  cursor:default;
  }

  .hovereffect .overlay {
  width:100%;
  height:100%;
  position:absolute;
  overflow:hidden;
  top:0;
  left:0;
  opacity:0;
  background-color:rgba(0,0,0,0.5);
  -webkit-transition:all .4s ease-in-out;
  transition:all .4s ease-in-out
  }

  .hovereffect img {
  display:block;
  position:relative;
  -webkit-transition:all .4s linear;
  transition:all .4s linear;
  }

  .hovereffect h2 {
  text-transform:uppercase;
  color:#fff;
  text-align:center;
  position:relative;
  font-size:17px;
  background:rgba(0,0,0,0.6);
  -webkit-transform:translatey(-100px);
  -ms-transform:translatey(-100px);
  transform:translatey(-100px);
  -webkit-transition:all .2s ease-in-out;
  transition:all .2s ease-in-out;
  padding:10px;
  }

  .hovereffect a.info {
  text-decoration:none;
  display:inline-block;
  text-transform:uppercase;
  color:#fff;
  border:1px solid #fff;
  background-color:transparent;
  opacity:0;
  filter:alpha(opacity=0);
  -webkit-transition:all .2s ease-in-out;
  transition:all .2s ease-in-out;
  margin:50px 0 0;
  padding:7px 14px;
  }

  .hovereffect a.info:hover {
  box-shadow:0 0 5px #fff;
  }

  .hovereffect button.info {
  text-decoration:none;
  display:inline-block;
  text-transform:uppercase;
  color:#fff;
  border:1px solid #fff;
  background-color:transparent;
  opacity:0;
  filter:alpha(opacity=0);
  -webkit-transition:all .2s ease-in-out;
  transition:all .2s ease-in-out;
  margin:50px 0 0;
  padding:7px 14px;
  }

  .hovereffect button.info:hover {
  box-shadow:0 0 5px #fff;
  }

  .hovereffect:hover img {
  -ms-transform:scale(1.2);
  -webkit-transform:scale(1.2);
  transform:scale(1.2);
  }

  .hovereffect:hover .overlay {
  opacity:1;
  filter:alpha(opacity=100);
  }

  .hovereffect:hover h2,.hovereffect:hover a.info {
  opacity:1;
  filter:alpha(opacity=100);
  -ms-transform:translatey(0);
  -webkit-transform:translatey(0);
  transform:translatey(0);
  }

  .hovereffect:hover a.info {
  -webkit-transition-delay:.2s;
  transition-delay:.2s;
  }

  .hovereffect:hover h2,.hovereffect:hover button.info {
  opacity:1;
  filter:alpha(opacity=100);
  -ms-transform:translatey(0);
  -webkit-transform:translatey(0);
  transform:translatey(0);
  }

  .hovereffect:hover button.info {
  -webkit-transition-delay:.2s;
  transition-delay:.2s;
  }

  .bankphotonav {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    width: 400px;
  }

  @media(max-width:768px){
    .bankphotonav {
      width: 300px;
    }
  }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('home') }}" class="navbar-brand"><b>Bank</b> Photos</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="@if($halaman=='home'){ {{'active'}} }@endif"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" style='cursor:pointer'>Categories <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @foreach($categories as $key => $rows)
                  <!-- <li><a href="categories/{{ $rows->name }}">{{ $rows->name }}</a></li> -->
                @endforeach

                @php
                $countercategories = 0;
                @endphp

                <li>
                    <div class='bankphotonav'>
                    <table width='100%'>
                    @foreach($categories as $key => $value)
                    
                    @if($countercategories % 3 == 0) <tr> @endif

                    <td style='padding: 5px'><a href="{{ url('categories/'.$value->name) }}">{{ $value->name }}</a></td>

                    @if($countercategories % 3 == 2) </tr> @endif

                    @php
                    $countercategories++;
                    @endphp

                    @endforeach
                    </table>
                    </div>
                </li>

              </ul>
            </li>
            <li class="@if($halaman=='upload'){ {{'active'}} }@endif visible-xs visible-sm"><a href="{{ route('upload') }}">Upload</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search" action='{{url('search')}}' method='GET' id='searchphoto' autocomplete='off'>
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" name='keywords' id='keywords' required>
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="@if($halaman=='upload'){ {{'active'}} }@endif hidden-sm hidden-xs"><a href="{{ route('upload') }}">Upload</a></li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/storage/{{ $auth->photo }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{!! "@".$auth->username !!}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/storage/{{ $auth->photo }}" class="img-circle" alt="User Image">

                  <p>
                    {{ $auth->fullname }}
                    <br>
                    {!! "@".$auth->username !!}
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('signout') }}" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>
            @yield('title')
            <small>@yield('smalltitle')</small>
        </h1>
      </section>

      <section class="content" style="margin: 10px 0;">
        
        @yield('content')

      </section>

    </div>
  </div>
  <footer class="main-footer navbar-bottom">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2017 <a>Bank Photos</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('plugins/swal/sweetalert.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('plugins/adminlte/js/app.min.js') }}"></script>
</body>
</html>
@yield('javascript')