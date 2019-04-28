@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
          <div class="video">
            <div class="col-md-12 col-sm-12">
              <div class="col-md-12 col-sm-12">
                  <iframe href="{{ url('/favorites/watch=$rezults->videoId') }}" width="720" height="480" src="https://www.youtube.com/embed/{{$rezults->videoId}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              <div class="col-md-12 col-sm-12">
                  <h1>{{$rezults->title}}</h1>
                  <h5>{{$rezults->date}}</h3>
                  <h3>{{$rezults->description}}</h2><br>
                  <a href="{{ url('/favorites') }}" role="button" aria-expanded="false" value="{{$rezults->videoId}}"
                    onclick="event.preventDefault();
                             document.getElementById('{{$rezults->videoId}}').submit();">
                    Remove from favorites</a>
                  <form id="{{$rezults->videoId}}" action="{{ url('/favorites') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                      <input name="video" type="text" value="{{$rezults->videoId}}">
                  </form>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
