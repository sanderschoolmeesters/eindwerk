@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user())

                       <h1> Welcome {{$user->name}} </h1>

                       <div>Actieve tickets: "#tickets"</div>

                    @else
                        <a href="/login">Log in</a> of <a href="/register">maak een account aan.</a>
                    @endif

                </div>
            </div>
        </div>

        @if(auth()->user()->role_id == 2)

        <div class="col-md-4">
            <div class="row">
                <div class="card">
                    <div class="card-header">Ticket aanmaken</div>
                        <div class="card-body">

                            <a href="/userTicket" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Ticket aanmaken</a>

                        </div>
                </div>
            </div>


            <div class="row">
                <div class="card">
                    <div class="card-header">mijn Tickets</div>
                        <div class="card-body">

                            <a href="/userTickets" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn Tickets</a>


                        </div>
                </div>
            </div>


            <div class="row">
                <div class="card">
                    <div class="card-header">mijn profiel</div>
                        <div class="card-body">

                            <a href="/userProfile" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn profiel</a>


                        </div>
                </div>
            </div>
        </div>

    </div>
</div>

@else

<div class="col-md-4">
    <div class="row">
        <div class="card">
            <div class="card-header">Actieve Tickets</div>
                <div class="card-body">

                    <a href="/adminTicket" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Actieve Tickets</a>


                </div>
        </div>
    </div>


    <div class="row">
        <div class="card">
            <div class="card-header">mijn profiel</div>
                <div class="card-body">

                    <a href="/adminProfile" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn profiel</a>


                </div>
        </div>
    </div>
</div>

</div>
</div>


@endif


@endsection
