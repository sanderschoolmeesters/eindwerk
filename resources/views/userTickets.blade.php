<?php

$tickets = DB::select('select * from tickets', [1]);
$backgroundcolor = "#eae7dc";
$navbackgroundcolor = "#eae7dc";
$navcolor = "#8e8d8a";
$tickettitlecolor = "#61892f";
$ticketquestioncolor = "#8fc1e3";
$color = "#e85a4f"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
</head>
<!-- Page Background Color -->
<body style="color:<?php echo $color;?>; background-color: <?php echo $backgroundcolor;?>; font-family: GFS Didot;">
    <!-- Nav Background Color -->
    <nav style="color:<?php echo $navcolor;?>; background-color: <?php echo $navbackgroundcolor;?>;" class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a style="color:<?php echo $navcolor;?>;" class="navbar-brand" href="{{ url('/') }}">
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
                            <a style="color:<?php echo $navcolor;?>;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a style="color:<?php echo $navcolor;?>;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a style="color:<?php echo $navcolor;?>;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div style="color:<?php echo $navcolor;?>;" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                                {{-- voor user --}}
                                @if (Auth::user()->role_id == 2)
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ url('/userTickets') }}">
                                    Mijn tickets
                                </a>
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ url('/userTicket') }}">
                                    Nieuwe ticket
                                </a>
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ url('/userProfile') }}">
                                    Mijn profiel
                                </a>
                                @endif

                                {{-- voor admin --}}
                                @if (Auth::user()->role_id == 1)
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ url('/adminTicket') }}">
                                    Actieve tickets
                                </a>
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ url('/adminProfile') }}">
                                    Mijn admin profiel
                                </a>
                                @endif

                                {{-- logout --}}
                                <a style="color:<?php echo $navcolor;?>;" class="dropdown-item" href="{{ route('logout') }}"
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

    <div class="container-fluid justify-content-center">
        <h1 style="color: snow;">Mijn Tickets</h1>
    <?PHP 
        foreach ($tickets as $ticket) {
        echo '  <div class="row">
                <div style="margin: 25px;"  class="col-sm-6 text-left"> 
                <!-- Ticket Title Color -->
                <div class="card">
                <div style="margin: 10px;" class="card-title"><h2>'. $ticket->title.'</h2></div>
                <!-- Ticket Question Color -->
                <div style="background-color:'. $ticketquestioncolor .'; color:snow;" class="card-body">'. $ticket->question.'</div></div></div></div>';
        }
      ?>
    </div>
</body>
</html>

<!-- /* function newTicket($ticketcategory_id,$title,$question,$user_id){
    DB::insert('insert into tickets (id, ticketcategory_id, title, question, user_id) values (?, ?, ?, ?, ?)', [null, $ticketcategory_id, $title, $question, $user_id]);
} */ -->
