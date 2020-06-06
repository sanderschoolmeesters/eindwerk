


@extends('layouts.app')


@section('content')

    <section id="" class="">
        <div class="container">
            <div class="row">
                <h2>Ticket aanmaken</h2>
            </div>
            <div class="row">
                <div>
                    <form method="post" action="/userTickets" enctype="multipart/form-data" >

                        @csrf
                        <div class="form-group">

                            <label>Categorieen</label>
                            <select class="form-control" name="ticketcategorie">
                              @foreach($ticketcategories as $category)
                              <option value="{{ $category->id }}">{{ $category->name}}</option>
                              @endforeach
                            </select>
                          </div>

                         <div class="form-group">
                            <label>titel</label>
                            <input type="name" class="form-control" name="title" value="{{ old('title') }}">
                          <span class="small text-danger">{{ $errors->first('title') }}</span>
                         </div>

                         <div class="form-group">
                            <label>Vraag</label>
                            <input type="name" class="form-control" name="question" value="{{ old('question') }}">
                          <span class="small text-danger">{{ $errors->first('question') }}</span>
                         </div>
                         <button type="submit" class="btn btn-primary mb-2">Verzend uw vraag</button>
                    </form>

                </div>

            </div>

        </div>
    </section>

@endsection
