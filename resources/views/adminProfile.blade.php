@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (auth()->user()->role_id == 1)
            <h2>Mijn admin profiel</h2>
            @else
            <h2>Profiel van admin: {{$user->name}}</h2>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <br>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="/storage/userimage/{{$user->image}}" class="card-img" alt="admin image">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Gegevens</h5>
                      <p class="card-text"><b>Naam: </b> {{$user->name}}</p>
                      <p class="card-text"><b>E-mail: </b> {{$user->email}}</p>
                      <p class="card-text"><b>Actief sinds: </b> {{$user->created_at}}</p>
                      <p class="card-text"><b>Aantal opgeloste tickets: </b> {{count($compTicket)}}</p>
                      <br>
                      <hr>
                      @if (auth()->user()->role_id == 1)
                      <form method="POST" action="/adminProfile" enctype="multipart/form-data">
                        @csrf
                        <input name="image" type="file">
                        <button name="submit" type="submit" class="btn btn-primary">Verander profielfoto</button>
                      </form>   
                      @endif                    
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                  <div class="col-md-8">
                    {{-- reviews --}}
                    <div class="card-body">
                      <h5 class="card-title">Reviews</h5>
                      {{-- niet zichtbaar voor admins --}}
                      @if (auth()->user()->role_id != 1)
                      {{-- reviews --}}
                      @foreach ($reviews as $review)
                      <p class="card-text"><b>Beoordeling</b>: {{$review->review}}</p>
                      <select name="stars" >
                        <option @if ($review->stars == 1) selected="selected" @endif disabled value="1">&#9733;</option>
                        <option @if ($review->stars == 2) selected="selected" @endif disabled value="2">&#9733;&#9733;</option>
                        <option @if ($review->stars == 3) selected="selected" @endif disabled value="3">&#9733;&#9733;&#9733;</option>
                        <option @if ($review->stars == 4) selected="selected" @endif disabled value="4">&#9733;&#9733;&#9733;&#9733;</option>
                        <option @if ($review->stars == 5) selected="selected" @endif disabled value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                      </select>
                      <br>
                      <br>
                      @endforeach
                      @endif
                      {{-- niet zichtbaar voor users --}}
                      @if (auth()->user()->role_id != 2)
                      <a href="/adminReviews/{{$user->id}}">Bekijk hier jouw reviews</a>  
                      @endif
                      @if (auth()->user()->role_id == 2)
                      <form method="POST" action="/adminProfile/review/{{$user->id}}" enctype="multipart/form-data" class="form-group">
                        @csrf
                        Beoordeling: <input name="review" type="text" class="form-control">
                        <br>
                        Aantal sterren: 
                        <select name="stars" >
                            <option value="1">&#9733;</option>
                            <option value="2">&#9733;&#9733;</option>
                            <option value="3">&#9733;&#9733;&#9733;</option>
                            <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                            <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                        </select>
                        <br>
                        <hr>
                        <button name="submit" type="submit" class="btn btn-primary">Verstuur review</button>
                      </form> 
                      @endif                      
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
