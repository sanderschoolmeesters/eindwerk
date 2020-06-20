<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Helpdesk</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #fefffff;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Helpdesk
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- voor user --}}
                                    @if (Auth::user()->role_id == 2)
                                    <a class="dropdown-item" href="{{ url('/userTickets') }}">
                                        Mijn tickets
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/userTicket') }}">
                                        Nieuwe ticket
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/userProfile') }}">
                                        Mijn profiel
                                    </a>
                                    @endif

                                    {{-- voor admin --}}
                                    @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item" href="{{ url('/adminTicket') }}">
                                        Actieve tickets
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/adminProfile') }}">
                                        Mijn admin profiel
                                    </a>
                                    @endif
                                    {{-- logout --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>



<footer class="footer font-small blue pt-4
>


    <div class="container-fluid text-center text-md-left">


      <div class="row">


        <div class="col-md-6 mt-md-0 mt-3">


          <h5 class="text-uppercase">Footer Content</h5>
          <p>Here you can use rows and columns to organize your footer content.</p>

        </div>


        <hr class="clearfix w-100 d-md-none pb-3">


        <div class="col-md-3 mb-md-0 mb-3">

          <h5 class="text-uppercase">Contact</h5>

        </div>

        <div class="col-md-3 mb-md-0 mb-3">

          <h5 class="text-uppercase">Links</h5>



        </div>


      </div>


    </div>

  </footer>






</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
</html>
