@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">

        <h2>Profiel: {{$user->name}}</h2>

    </div>

    <div class="row">

            <div class="card mb-6">
                <div class="card-body">
                    <h5 class="card-title">Gegevens</h5>
                    <p class="card-text"><b>Naam: </b> {{$user->name}}</p>
                    <p class="card-text"><b>E-mail: </b> {{$user->email}}</p>

                    <form method="POST" action="/userProfile" enctype="multipart/form-data">
                        @csrf
                        <input name="image" type="file">
                        <button name="submit" type="submit" class="btn btn-primary">Verander profielfoto</button>
                      </form>
                </div>
            </div>

    </div>

    @endsection
