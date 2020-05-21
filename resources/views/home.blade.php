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
                        U bent ingelogged!
                    @else
                        <a href="/login">Log in</a> of <a href="/register">maak een account aan.</a>
                    @endif
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
