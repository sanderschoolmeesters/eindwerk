@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      @if (auth()->user()->role_id == 1)
      <a href="/adminTicket" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Terug naar actieve tickets</a>
      @else
      <a href="/userTickets" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Terug naar actieve tickets</a>
      @endif
      <br>
      <br>
      {{-- chat en ticket verwijderen enkel voor admin --}}
       @if (auth()->user()->role_id == 1)                
        <form method="post" action="/chatAdmin/{{$currentTicket->id}}">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" type="delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Sluit ticket af</button>
        </form>
        @endif
        <br>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Chat</h2>
            @if (auth()->user()->id == 2)
                <h4>Jouw vraag: <b>{{$currentTicket->title}} - {{$currentTicket->question}}</b></h4>
            @else
                <h4>Oorspronkelijke title + vraag: <b>{{$currentTicket->title}} - {{$currentTicket->question}}</b></h4>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div id="chat">
            @foreach ($conversation as $convo)
                {{-- Huidig ingeloggde gebruiker eigen naam niet klikbaar maken + admin niks klikbaar --}}
                @if (auth()->user()->id != $convo->user->id && auth()->user()->role_id == 2)
                  <p style="margin:0px 5px 0px 5px;">
                    <a href="/adminProfile/guest/{{$convo->user->id}}">
                    <b>{{$convo->user->name}}</b>
                    </a>: {{$convo->conversation}}
                    <br>
                    <small>{{$convo->created_at}}</small>
                  </p>
                  <hr>
                @else
                  <p style="margin:5px;">
                    <b>{{$convo->user->name}}</b>: 
                    {{$convo->conversation}}
                    <br>
                    <small>{{$convo->created_at}}</small>
                  </p>
                  <hr>
                @endif
              @endforeach
          </div>
          <br>
            {{-- bericht vesturen --}}
              <form method="post" action="/chatAdmin/{{$currentTicket->id}}">
                @csrf
                <input autofocus="autofocus" name="chat" class="form-control" style="width: 70%;display: inline-block" type="text">
                <input type="submit" class="btn btn-primary">
              </form>
              <br>
        </div>
    </div>
</div>
@endsection
