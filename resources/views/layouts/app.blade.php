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
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>TeneJob</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="data:image/png;base64,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"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="data:image/png;base64,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"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
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
            <strong>Copyright © 2016 <a href="#">TeneJob</a>.</strong> All rights reserved.
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