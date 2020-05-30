@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Actieve tickets</h2>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-dark">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Categorie</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tickets as $ticket)
                  <tr>
                    <td>{{$ticket->id}}</td>
                    <td>{{$ticket->title}}</td>
                    <td>{{$ticket->ticketcategory->name}}</td>
                  <td><a href="/chatAdmin/{{$ticket->id}}" class="btn btn-primary">Ga naar chat</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>  
        </div>
    </div>
</div>
@endsection
