<!DOCTYPE html>
<html lang="es" class="no-js">
<head>
    <!-- CSS -->
   
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema Pedidos - @yield('title')</title>
    <script>
            // Wait for window load
            
        </script>	
    
</head>
<body>


    <div class="container-fluid">
        <div id="wrapper" class="animate">
                <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
                  <a class="navbar-brand" href="{{ route('admin') }}">
                      <img src="https://i.pinimg.com/originals/09/81/d5/0981d5429a9d2a6ee06073d1727975db.png" class="rounded-circle" alt="Cinque Terre" width="60" height="60"> 
                  </a>

                  @if(Auth::user()->isAdmin == 1)    
                  <p class="mt-3 text-light"><i class="far fa-user"></i> Administrador</p>
                  @endif
                

                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-md-auto d-md-flex">
                      
                        
                        @can('admin-only',auth()->user())

                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i> Estadisticas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('ventas') }}"><i class="fas fa-chart-line"></i> Estadisticas Ventas Gráficos</a>
                              
                            </div>
                            
                          </li>

                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-hand-holding-usd"></i>  Adm. Productos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('productos') }}"><i class="fas fa-utensils"></i> Productos</a>
                              <a class="dropdown-item" href="{{ route('categorias') }}"><i class="fas fa-list-alt"></i> Categorias</a>
                              <a class="dropdown-item" href="{{ route('mesas') }}"><i class="fas fa-th-large"></i> Mesas</a>
                              <a class="dropdown-item" href="{{ route('menu') }}"><i class="fas fa-bars"></i> Menu</a>
                              
                            </div>
                          </li>

                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users"></i> Adm. Personal
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('trabajadores') }}"> <i class="fas fa-id-card"></i> Trabajadores</a>
                              <a class="dropdown-item" href="{{ route('cargos') }}"><i class="fas fa-users-cog"></i> Cargos</a>
                              <a class="dropdown-item" href="{{ route('usuarios') }}"><i class="fas fa-user-lock"></i> Usuarios Sistema</a>
                            </div>
                          </li>
                          @endcan
                      <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('pendientes') }}"><i class="fas fa-exclamation-circle"></i> Pedidos Pendientes
                        </a>
                      </li>
                      <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('finalizados') }}"> <i class="fas fa-check-circle"></i> Pedidos Finalizados</a>
                      </li>

                      @guest
                      <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <i class="fas fa-user-circle"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Cerrar sesión') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest

                    </ul>
                  </div>
                </nav>
             
              </div>
        
        
    @yield('content')
    
</div> <!-- /container-fluid  -->
    <script src="https://js.pusher.com/4.1/pusher.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js" defer></script>
    <script src="{{ asset('js/chartjs.js') }}" defer></script>
    @yield('scriptspages')
    
   
      
</body>
</html>