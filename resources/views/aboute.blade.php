@extends('layouts.app')
@section('content')

    @foreach($users as $user)
      <h1>{{$user->name}} {{$user->password}}</h1>
    @endforeach


@endsection
