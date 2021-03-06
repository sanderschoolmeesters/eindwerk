@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
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



                    @else
                        <a href="/login">Log in</a> of <a href="/register">maak een account aan.</a>
                    @endif








                    @if(auth()->user()->role_id == 2)

                    <div>aantal open tickets : {{count($amount)}}</div>

                        <h2>laatse tickets</h2>
                    @foreach ($last as $A)

                    <div class="card">
                        <div class="card-header">
                            Ticket:{{ $A->id }}
                          </div>
                        <div class="card-body">
                    <div>Tittle: {{$A->title}}</div>
                    {{-- <div>Categorie: {{ $A->ticketcategory->name }}</div> --}}
                    <div>Question: {{$A->question}}</div>
                    {{-- <a href="/chatAdmin/{{$tickets->id}}" class="btn btn-primary">chat</a> --}}

                        </div>
                    </div>
                    @endforeach

                    <a href="/userTicket" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Ticket aanmaken</a>

                    @endif


                </div>
            </div>
        </div>

        @if(auth()->user()->role_id == 2)

        <div class="col-md-3">

            <div class="row">

                <div class="card">
                    <img class="card-img-top" src="storage/userimage/{{$user->image}}" alt="Card image cap">
                    <div class="card-body">
                      <h2 class="card-text">{{$user->name}}</h2>
                      <a href="/userProfile" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn profiel</a>
                      <a href="/userTickets" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn Tickets</a>

                    </div>
                </div>
            </div>




        </div>

    </div>
</div>

@else

<div class="col-md-3">
    <div class="row">

        <div class="card">
            <img class="card-img-top" src="storage/userimage/{{$user->image}}" alt="Card image cap">
            <div class="card-body">
              <h2>{{$user->name}}</h2>
              <a href="/adminProfile" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">mijn profiel</a>
              <a href="/adminTicket" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Actieve Tickets</a>


            </div>
        </div>


    </div>



</div>

</div>
</div>


@endif


@endsection
