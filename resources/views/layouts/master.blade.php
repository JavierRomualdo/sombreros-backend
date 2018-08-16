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

    <title>{{ config('app.name', 'Sombreros') }}</title>

    <!--Nuevos estilos-->
    <!--<link rel="stylesheet" href="{{asset('bootstrap4/vendor/bootstrap/css/bootstrap.min.css')}}">-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap4/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap4/css/fontastic.css')}}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/roboto.css')}}">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/grasp_mobile_progress_circle-1.0.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap4/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}"> 
    <link rel="stylesheet" href="{{asset('bootstrap4/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/custom.css')}}">

    <link rel="stylesheet" href="{{asset('ionic/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap4/css/style.default.premium.css')}}" id="theme-stylesheet">
    
    <!--Galerya-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/galery/lightbox.min.css')}}">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('bootstrap4/img/favicon.ico')}}">
    <script src="{{asset('bootstrap4/vendor/jquery/jquery.min.js')}}"></script>   
    <script src="{{asset('js/loader.js')}}"></script>
    <script src="{{asset('js/jsapi.js')}}"></script>


    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <script src="{{asset('bootstrap4/js/99347ac47f.js')}}"></script>
    <!-- Font Icons CSS-->
    <link rel="stylesheet" href="{{asset('bootstrap4/css/icons.css')}}">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
        <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--><![endif]-->


    <link rel="stylesheet" href="{{asset('jquery-alertable-master/jquery.alertable.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap4/css/estilos.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <script src="{{asset('bootstrap4/js/menuPegagozo.js')}}"></script>
</head>
<body>
  <nav class="side-navbar fadeIn animated">
    <div class="side-navbar-wrapper fadeIn animated">
      <div class="sidenav-header d-flex align-items-center justify-content-center">
      <div class="sidenav-header-inner text-center"><a href="{{action('Usuarios\PerfilController@foto',Auth::user()->id)}}" title="editar foto"><img src="/images/usuarios/{{Auth::user()->photo}}" alt="person" class="img-fluid rounded-circle"></a>
          <h2 class="h6"><a href="{{action('Usuarios\PerfilController@indexPerfil',Auth::user()->id)}}"><label for="" id="usuario">{{ Auth::user()->name }}</label></a></h2>
          @if(Auth::user()->idCargo == 1) 
            <span class="text-uppercase">Usuario</span>
          @else
            <!--idcargo == 2-->
            <span class="text-uppercase">Administrador</span>
          @endif
          
        </div>
        <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>S</strong><strong class="text-primary">G</strong></a></div>
    </div>
      <div class="main-menu fadeIn animated">
        <h5 class="sidenav-heading">Main</h5>
        <ul id="side-main-menu" class="side-menu list-unstyled">
          <li class="{{active_menu(Route::currentRouteName(), 'home', 0, 4)}}"><a href="{{url('home')}}"><i class="ion-ios-home-outline"></i><span>Home</span></a></li>
          <li> <a href="#pages-sombreros-list" data-toggle="collapse" 
            aria-expanded="{{ Request::is('gastronomica/sombreros/sombreros/sombrero') 
              || Request::is('gastronomica/sombreros/modelos/modelo') 
              || Request::is('gastronomica/sombreros/materiales/material') 
              || Request::is('gastronomica/sombreros/tejidos/tejido') 
              || Request::is('gastronomica/sombreros/tallas/talla') 
              || Request::is('gastronomica/sombreros/publicodirigido/publicodirigido') ? 'true' : 'false' }}"><i class="ion-ios-people-outline"></i><span>Sombreros</span></a>
            <ul id="pages-sombreros-list" class="collapse list-unstyled {{ Request::is('gastronomica/sombreros/sombreros/sombrero')  
            || Request::is('gastronomica/sombreros/modelos/modelo') 
            || Request::is('gastronomica/sombreros/materiales/material') 
            || Request::is('gastronomica/sombreros/tejidos/tejido') 
            || Request::is('gastronomica/sombreros/tallas/talla') 
            || Request::is('gastronomica/sombreros/publicodirigido/publicodirigido') ? 'show' : '' }}">
              <li class="{{active_menu(Route::currentRouteName(), 'sombrero', 0, 8)}}"> <a href="{{url('gastronomica/sombreros/sombreros/sombrero')}}"><i class="icon-list-1"></i><span>Sombrero</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'modelo', 0, 6)}}"> <a href="{{url('gastronomica/sombreros/modelos/modelo')}}"><i class="icon-presentation"></i><span>Modelo</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'material', 0, 8)}}"> <a href="{{url('gastronomica/sombreros/materiales/material')}}"><i class="icon-pencil-case"></i><span>Material</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'tejido', 0, 6)}}" id="li-tej"> <a href="{{url('gastronomica/sombreros/tejidos/tejido')}}"><i class="icon-check"></i><span>Calidad Tejido</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'talla', 0, 5)}}"> <a href="{{url('gastronomica/sombreros/tallas/talla')}}"><i class="icon-mail"></i><span>Talla</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'publicodirigido', 0, 15)}}"> <a href="{{url('gastronomica/sombreros/publicodirigido/publicodirigido')}}"><i class="icon-check"></i><span>Publico Dirigido</span></a></li>
            </ul>
          </li>
          <li> <a href="#pages-nav-list" data-toggle="collapse" 
            aria-expanded="{{ Request::is('gastronomica/proveedores/proveedores/proveedor') 
              || Request::is('gastronomica/proveedores/proveedores/datos') 
              || Request::is('gastronomica/proveedores/costos/costos') ? 'true' : 'false' }}"><i class="icon-interface-windows"></i><span>Proveedores</span></a>
            <ul id="pages-nav-list" class="collapse list-unstyled {{ Request::is('gastronomica/proveedores/proveedores/proveedor') 
            || Request::is('gastronomica/proveedores/proveedores/datos') 
            || Request::is('gastronomica/proveedores/costos/costos') ? 'show' : '' }}">
              <li class="{{active_menu(Route::currentRouteName(), 'proveedor', 0, 9)}}"> <a href="{{url('gastronomica/proveedores/proveedores/proveedor')}}"> <i class="icon-check"></i><span>Proveedor</span></a></li>
              <li class="{{Request::is('gastronomica/proveedores/proveedores/datos') ? 'active':''}}"> <a href="{{url('gastronomica/proveedores/proveedores/datos')}}"> <i class="icon-check"></i><span>Datos</span></a></li>
              <li class="{{active_menu(Route::currentRouteName(), 'costos', 0, 6)}}"> <a href="{{url('gastronomica/proveedores/costos/costos')}}"> <i class="icon-check"></i><span>Costos</span></a></li>
            </ul>
          </li>
          <li class="{{active_menu(Route::currentRouteName(), 'cliente', 0, 7)}}"><a href="{{url('gastronomica/sombreros/clientes/cliente')}}"><i class="icon-interface-windows"></i><span>Clientes</span></a></li>          
          </ul>
        </div>

        <div class="main-menu fadeIn animated">
          <h5 class="sidenav-heading">Second</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
            <!--{{active_menu(Route::currentRouteName(), 'pedidoreposicion', 0, 16)}}-->
            <li class="{{Request::is('gastronomica/sombreros/pedidosreposicion/pedidoreposicion') ? 'active':''}}"> <a href="{{url('gastronomica/sombreros/pedidosreposicion/pedidoreposicion')}}"> <i class="icon-check"></i><span>Pedido Reposicion</span></a></li>            
            <li class="{{active_menu(Route::currentRouteName(), 'ordencompra', 0, 11)}}"> <a href="{{url('gastronomica/sombreros/ordencompra/ordencompra')}}"> <i class="icon-check"></i><span>Orden de Compra</span></a></li>
            <li class="{{active_menu(Route::currentRouteName(), 'guiaingreso', 0, 11)}}"> <a href="{{url('gastronomica/sombreros/guiaingreso/guiaingreso')}}"> <i class="icon-check"></i><span>Guia Ingreso</span></a></li>
            <li> <a href="#pages-nav-ventas" data-toggle="collapse" 
              aria-expanded="{{ Request::is('gastronomica/sombreros/ventas/precios') 
              || Request::is('gastronomica/sombreros/ventas/ventas') 
              || Request::is('gastronomica/sombreros/ventas/cancelaciones/cancelacion') 
              || Request::is('gastronomica/sombreros/ventas/utilidades/utilidadcomision')   ? 'true' : 'false' }}"> <i class="ion-ios-cart-outline"></i><span>Ventas</span></a>
              <ul id="pages-nav-ventas" 
              class="collapse list-unstyled {{ Request::is('gastronomica/sombreros/ventas/precios') 
              || Request::is('gastronomica/sombreros/ventas/ventas')
              || Request::is('gastronomica/sombreros/ventas/cancelaciones/cancelacion') 
              || Request::is('gastronomica/sombreros/ventas/utilidades/utilidadcomision')   ? 'show' : '' }}">
                <li class="{{Request::is('gastronomica/sombreros/ventas/precios') ? 'active':''}}"><a href="{{url('gastronomica/sombreros/ventas/precios')}}"> <i class="ion-ios-cart-outline"></i><span>Precios</span></a></li>
                <li class="{{Request::is('gastronomica/sombreros/ventas/ventas') ? 'active':''}}"><a href="{{url('gastronomica/sombreros/ventas/ventas')}}"> <i class="ion-ios-cart-outline"></i><span>Nueva Venta</span></a></li>
                <!--<li class="{{active_menu(Route::currentRouteName(), 'cancelacion', 0, 11)}}"><a href="{{url('gastronomica/sombreros/ventas/cancelaciones/cancelacion')}}"> <i class="ion-ios-cart-outline"></i><span>Cancelacion</span></a></li>-->
                <li class="{{active_menu(Route::currentRouteName(), 'utilidadcomision', 0, 16)}}"><a href="{{url('gastronomica/sombreros/ventas/utilidades/utilidadcomision')}}"> <i class="ion-ios-cart-outline"></i><span>Utilidad-Comision</span></a></li>
              </ul>
            </li>
            <!--<li> <a href="#pages-nav-list-compras" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Compras</span></a>
            <ul id="pages-nav-list-compras" class="collapse list-unstyled">
              
              <li> <a href="{ {url('gastronomica/sombreros/factura/factura')}}"> <i class="icon-check"></i><span>Factura</span></a></li>
              <li> <a href=""> <i class="icon-check"></i><span>Reporte de Anomalias</span></a></li>
            </ul>
            </li>-->
          </ul>
        </div>

        <div class="main-menu fadeIn animated">
          <h5 class="sidenav-heading">Tercer</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">
          
          <li> <a href="#pages-nav-list-consultas" data-toggle="collapse" aria-expanded="false"><i class="ion-ios-paper-outline"></i><span>Consultas</span></a>
            <ul id="pages-nav-list-consultas" class="collapse list-unstyled">
              <li><a href="#pages-articulos" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Articulos</span></a>
                <ul id="pages-articulos" class="collapse list-unstyled">
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/articulos/stockactual')}}"> <i class="icon-check"></i><span>Stock Actual</span></a></li>
                </ul>
              </li>
              <li><a href="#pages-ordencompras" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Orden Compra</span></a>
                <ul id="pages-ordencompras" class="collapse list-unstyled">
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ordencompra/ordencompra')}}"> <i class="icon-check"></i><span>Orden de Compra</span></a></li>
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ordencompra/ordencompraproveedor')}}"> <i class="icon-check"></i><span>Por Proveedor</span></a></li>
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ordencompra/ordencompraarticulo')}}"> <i class="icon-check"></i><span>Por Articulo</span></a></li>
                </ul>
              </li>
              <li><a href="#pages-ventas" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Ventas</span></a>
                <ul id="pages-ventas" class="collapse list-unstyled">
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ventas/ventascliente')}}"> <i class="icon-check"></i><span>Por cliente</span></a></li>
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ventas/ventasvendedor')}}"> <i class="icon-check"></i><span>Por vendedor</span></a></li>
                  <!--<li id="li-prov"> <a href="{{url('gastronomica/sombreros/consultas/ventas/ventascancelacion')}}"> <i class="icon-check"></i><span>Por cancelacion</span></a></li>-->
                </ul>
              </li>   
            </ul>
          </li>
          <li> <a href="#pages-nav-list-reportes" data-toggle="collapse" aria-expanded="false"><i class="ion-clipboard"></i><span>Reportes</span></a>
            <ul id="pages-nav-list-reportes" class="collapse list-unstyled">
              <li id="li-prov"> <a href="{{url('gastronomica/sombreros/reportes/compras')}}"> <i class="icon-check"></i><span>Orden Compra</span></a></li>
              <li id="li-prov"> <a href="#pages-rventas" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Ventas</span></a>
                <ul id="pages-rventas" class="collapse list-unstyled">
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/reportes/ventas')}}"> <i class="icon-check"></i><span>Ventas</span></a></li>
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/reportes/ventasporempleado')}}"> <i class="icon-check"></i><span>Por vendedor</span></a></li>
                </ul>
              </li>
              <li id="li-prov"> <a href="#pages-utilidades" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Utilidades</span></a>
                <ul id="pages-utilidades" class="collapse list-unstyled">
                    <a href="{{url('gastronomica/sombreros/reportes/utilidadessombreros')}}"> <i class="icon-check"></i><span>Por Articulo</span></a>
                  <a href="{{url('gastronomica/sombreros/reportes/utilidades')}}"> <i class="icon-check"></i><span>Por Ventas</span></a>
                </ul>
              </li>
              <li id="li-prov"> <a href="#pages-movimientos" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Movimientos</span></a>
                <ul id="pages-movimientos" class="collapse list-unstyled">
                    <a href="{{url('gastronomica/sombreros/movimientos/movimientos')}}"> <i class="ion-arrow-move"></i><span>Movimientos</span></a>                  
                    <!--<a href="{{url('gastronomica/sombreros/movimientos/movimientogeneral')}}"> <i class="ion-arrow-move"></i><span>Movimientos</span></a>-->
                    <a href="{{url('gastronomica/sombreros/movimientos/movimientoporarticulo')}}"> <i class="ion-arrow-move"></i><span>Movimiento x Articulo</span></a>
                </ul>
              </li>
            </ul>
          </li>
          @if(Auth::user()->idCargo == 2 )
          <li> <a href="#pages-nav-list-configuracion" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Configuracion</span></a>
            <ul id="pages-nav-list-configuracion" class="collapse list-unstyled">
              <li> <a href="{{url('gastronomica/configuracion/usuarios/usuario')}}"> <i class="icon-user"></i><span>Usuarios</span></a></li>
              <li> <a href="{{url('gastronomica/configuracion/atributos/atributo')}}"> <i class="icon-interface-windows"></i><span>Parametros</span></a></li>
              <!--<li> <a href="{{url('gastronomica/configuracion/temporadas/temporada')}}"> <i class="icon-interface-windows"></i><span>Temporadas</span></a></li>-->
              <li><a href="#pages-empleados-list" data-toggle="collapse" aria-expanded="false"><i class="ion-ios-people-outline"></i><span>Trabajadores</span></a>
                <ul id="pages-empleados-list" class="collapse list-unstyled">
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/encargos/encargo')}}"> <i class="icon-check"></i><span>Encargos</span></a></li>
                  <li id="li-prov"> <a href="{{url('gastronomica/sombreros/empleados/empleado')}}"> <i class="icon-check"></i><span>Trabajador</span></a></li>
                  <!--<li id="li-prov"> <a href="{{url('gastronomica/sombreros/comisionempleado/comision')}}"> <i class="icon-check"></i><span>Comision</span></a></li>-->
                </ul>
              </li>             
            </ul>
          </li>
          @endif
          <li> <a href="#pages-nav-list-graficas" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Estadistica</span></a>
            <ul id="pages-nav-list-graficas" class="collapse list-unstyled">
              <li> <a href="{{url('gastronomica/sombreros/estadistica/stockactual')}}"> <i class="icon-user"></i><span>Stock Actual</span></a></li>
              <li><a href="#pages-grafica-ventas" data-toggle="collapse" aria-expanded="false"><i class="ion-ios-people-outline"></i><span>Ventas</span></a>
                <ul id="pages-grafica-ventas" class="collapse list-unstyled">
                  <li> <a href="{{url('gastronomica/sombreros/estadistica/ventas/porvendedor')}}"> <i class="icon-check"></i><span>Por vendedor</span></a></li>
                  <li> <a href="{{url('gastronomica/sombreros/estadistica/ventas/porarticulo')}}"> <i class="icon-check"></i><span>Por articulo</span></a></li>
                  <!--<li id="li-prov"> <a href="{{url('gastronomica/sombreros/comisionempleado/comision')}}"> <i class="icon-check"></i><span>Comision</span></a></li>-->
                </ul>
              </li>
              <li> <a href="{{url('gastronomica/sombreros/estadistica/utilidades/utilidadarticulos')}}"> <i class="icon-interface-windows"></i><span>Utilidades</span></a></li>
                           
            </ul>
          </li>
        </ul>
      </div>

      <!--<div class="admin-menu">
        <ul id="side-admin-menu" class="side-menu list-unstyled">
          <li> <a href="#pages-nav-list" data-toggle="collapse" aria-expanded="false"><i class="icon-interface-windows"></i><span>Dropdown</span>
              <div class="arrow pull-right"><i class="fa fa-angle-down"></i></div></a>
            <ul id="pages-nav-list" class="collapse list-unstyled">
              <li> <a href="#">Page 1</a></li>
              <li> <a href="#">Page 2</a></li>
              <li> <a href="#">Page 3</a></li>
              <li> <a href="#">Page 4</a></li>
            </ul>
          </li>
          <li> <a href="#"> <i class="icon-screen"> </i><span>Demo</span></a></li>
          <li> <a href="#"> <i class="icon-flask"> </i><span>Demo</span>
              <div class="badge badge-info">Special</div></a></li>
        </ul>
      </div>-->
    </div>
  </nav>

  <div class="page home-page">
    <header class="header fadeIn animated">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                <div class="brand-text hidden-sm-down"><span>System </span><strong class="text-primary"> Sombreros</strong></div></a></div>
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link logout"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Salir <i class="fa fa-sign-out"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <!--<a href="login.html" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a>-->
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    @yield('content')
    @include('partials.footer')
  </div>
     
    <script src="{{asset('bootstrap4/vendor/popper.js/umd/popper.min.js')}}"></script>   
    <script src="{{asset('bootstrap4/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script> 
    <script src="{{asset('bootstrap4/vendor/bootstrap/js/bootstrap.min.js')}}"></script>    
    <script src="{{asset('bootstrap4/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
    <script src="{{asset('bootstrap4/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('bootstrap4/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('bootstrap4/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    
    <script src="{{asset('bootstrap4/js/charts-home.js')}}"></script>
    <script src="{{asset('bootstrap4/js/front.js')}}"></script>
    <!--Galerya-->
    <script src="{{asset('bootstrap4/js/galery/lightbox.min.js')}}"></script>
    <!---->    
    
    

    <!-- Javascript files-->
    <!--<script src="{ {asset('bootstrap4/js/jquery.min.js')}}"></script>-->
    <!--<script src="{ {asset('bootstrap4/js/tether.min.js')}}"></script>-->
    <!--<script src="{ {asset('bootstrap4/js/jquery.cookie.js')}}"> </script>-->
    <!--<script src="{ {asset('bootstrap4/js/jquery.nicescroll.min.js')}}"></script>-->
    <!--<script src="{ {asset('bootstrap4/js/jquery.validate.min.js')}}"></script>-->
    <!--<script src="{ {asset('bootstrap4/js/charts-home.js')}}"></script>-->
    <!--<script src="{ {asset('bootstrap4/js/front.js')}}"></script>-->
    <script type="text/javascript" src="{{asset('jquery-alertable-master/jquery.alertable.js')}}"></script>
    <!--<script src="{{asset('js/reloj.js')}}"></script>-->
    <!-- Scripts -->
    <!--<script src="{#{ asset('js/app.js') }}"></script>-->
    <!-- Google Analytics: change UA-XXXXX-X to be your sites ID.-->
    
    <!--datatables-->
    <!--<script src="{{asset('bootstrap4/js/datatables/jquery-1.12.4.js')}}"></script>-->
  <script src="{{asset('bootstrap4/js/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <!--Notificacion-->
  <script src="{{asset('bootstrap4/js/notification/messenger.min.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/messenger-theme-flat.js')}}"></script>
  <script src="{{asset('bootstrap4/js/notification/components-notifications.js')}}"></script>


    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
</body>
</html>
