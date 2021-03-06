@extends('layouts.app')

@section('content')

    @foreach($rezults as $rezult)
    <div class="container">
        <div class="row">
          <div class="video">
            <div class="col-md-12 col-sm-12">
              <div class="col-md-6 col-sm-12">
                  <iframe href="{{ url('/favorites/watch=$rezult->videoId') }}" width="480" height="360" src="{{$rezult->img}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="col-md-6 col-sm-12">
                  <a role="button" href="{{ url('/favorites/watch=') }}{{$rezult->videoId}}">{{$rezult->title}}</a>
                  <h5>{{$rezult->date}}</h3>
                  <h3>{{$rezult->description}}</h2><br>
                  <a href="{{ url('/favorites') }}" role="button" aria-expanded="false" value="{{$rezult->videoId}}"
                    onclick="event.preventDefault();
                             document.getElementById('{{$rezult->videoId}}').submit();">
                    Remove from favorites</a>
                  <form id="{{$rezult->videoId}}" action="{{ url('/favorites') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      <input name="video" type="text" value="{{$rezult->videoId}}">
                  </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    @endforeach

@endsection
