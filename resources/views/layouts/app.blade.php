<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Polla Saint Honore</title>
    <link rel="shortcut icon" href="{{ asset('img/logs/favicon.ico') }}" type="image/vnd.microsoft.icon">



    <link href="{{ asset('/resources/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/resources/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/resources/css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">



</head>
<body>
    <div id="app">
        <div class="page-header container-fluid">
            <div class="col-lg-6">
                 <a href="#"><h1 class="logo">Polla Saint Honore</h1></a>                  
            </div>
            <div>
                  <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" class="stilyefont bold_font">Ingreso</a></li>
                        <li><a href="{{ url('/register') }}" class="stilyefont bold_font">Registrar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle stilyefont" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out bold_font"></i>Salir</a></li>
                                </ul>
                            </li>
                        @endif
                   </ul>
            </div>
            
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('resources/js/app.js') }}"></script>
    <script src="{{ asset('resources/js/vue.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="{{ asset('resources/js/toastr.min.js') }}"></script>
</body>
</html>
