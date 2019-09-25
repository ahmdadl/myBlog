@extends('layouts.app')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <div class='row'>
        <div class="card text-left">
          <img class="card-img-top" src="{{asset('img/'.$post->img)}}" alt="">
          <div class="card-body">
            <h4 class="card-title">{{$post->title}}</h4>
            <p class="card-text">{{$post->body}}</p>
          </div>
        </div>
    </div>
@endsection