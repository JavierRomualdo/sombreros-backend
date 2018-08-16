<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
  	<link rel="icon" type="image/png" href="{{asset('img/icon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--     Fonts and icons     -->
  	<link rel="stylesheet" href="{{asset('css/icon.css')}}" />
    <!--https://fonts.googleapis.com/icon?family=Material+Icons-->
      <link rel="stylesheet" type="text/css" href="{{asset('css/roboto.css')}}" />
      <!--https://fonts.googleapis.com/css?family=Roboto:300,400,500,700-->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!--https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css-->

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/material-kit.css')}}" rel="stylesheet">
    <!-- Styles -->
    <!--<link href="{#{ asset('css/app.css') }}" rel="stylesheet">-->
</head>


<body>
    <div class="signup-page">

      <nav class="navbar navbar-transparent navbar-absolute">
          <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="http://www.creative-tim.com">Creative Tim</a>-->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
              </div>

              <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-right">
                  @guest
                      <li><a href="{{ route('login') }}">Login</a></li>
                      <li><a href="{{ route('register') }}">Register</a></li>
                  @else
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu">
                              <li>
                                  <a href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                              </li>
                          </ul>
                      </li>
                  @endguest
                </ul>
              </div>
          </div>
        </nav>
        <div class="wrapper">
      		<div class="header header-filter" style="background-image: url('{{asset('img/mancora-peru.jpg')}}'); background-size: cover; background-position: top center;">
            @yield('content')
            <footer class="footer">
      		        <div class="container">
      		            <nav class="pull-left">
      						<ul>
      							<li>
      								<a href="http://www.creative-tim.com">
      									Creative Tim
      								</a>
      							</li>
      							<li>
      								<a href="http://presentation.creative-tim.com">
      								   About Us
      								</a>
      							</li>
      							<li>
      								<a href="http://blog.creative-tim.com">
      								   Blog
      								</a>
      							</li>
      							<li>
      								<a href="http://www.creative-tim.com/license">
      									Licenses
      								</a>
      							</li>
      						</ul>
      		            </nav>
      		            <div class="copyright pull-right">
      		                &copy; 2016, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com" target="_blank">Creative Tim</a>
      		            </div>
      		        </div>
      		    </footer>
          </div>

        </div>

    </div>

    <!--   Core JS Files   -->
  	<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
  	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
  	<script src="{{asset('js/material.min.js')}}"></script>

  	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  	<script src="{{asset('js/nouislider.min.js')}}" type="text/javascript"></script>

  	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
  	<script src="{{asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

  	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
  	<script src="{{asset('js/material-kit.js')}}" type="text/javascript"></script>


    <!-- Scripts -->
    <!--<script src="{#{ asset('js/app.js') }}"></script>-->
</body>
</html>
