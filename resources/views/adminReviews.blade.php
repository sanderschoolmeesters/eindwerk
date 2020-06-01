@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Jouw reviews</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    @foreach ($reviews as $review)
                    <p class="card-text"><b>-</b> {{$review->review}} <small>{{$review->created_at}}</small></p>
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
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
