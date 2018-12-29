<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TeneJob</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')
    <style>
        #showMenuBtn {
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
        }
        .show-menu {
            transform: translate(0, 0);
            box-shadow: 0px 0px 30px 15px;
            top: 100px;
            padding-top: 0;
        }
    </style>
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('/') }}/home" class="logo">
                <b>TeneJob</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu pull-left">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li id="showMenuBtn"
                            class="user user-menu visible-xs-block"
                            style="line-height: 52px; color: white;">
                            <a href="#"
                               onclick="
                                    event.preventDefault();
                                    $('aside.main-sidebar').toggleClass('show-menu');
                                    $(this).find('span').text() === 'Show Menu' ?
                                    $(this).find('span').text('Hide Menu') :
                                    $(this).find('span').text('Show Menu');"
                            >
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                &nbsp;<span>Show Menu</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- User Account Menu -->
                        <li class="user user-menu"
                            style="line-height: 52px; color: white; margin: 0 15px;">
                            Logged in as <b><u>{!! Auth::user()->name !!}</u></b>.
                            Member since {!! Auth::user()->created_at->format('M. d, Y') !!}
                        </li>
                        <li class="user user-menu">
                            <a href="{!! url('/logout') !!}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                &nbsp;Sign Out
                            </a>
                            <form id="logout-form"
                                  action="{{ url('/logout') }}"
                                  method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © {{ date('Y') }} <a href="#">TeneJob</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    TeneJob
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jQuery 3.1.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

    @yield('scripts')
</body>
</html>