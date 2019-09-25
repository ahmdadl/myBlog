@extends('layouts.app')

@section('title')
    all posts
@endsection

@section('content')
    <div class="row">
        @foreach ($posts as $post)
            <div class='card col-sm-6 col-md-4 col-lg-3'>
                <div class="card border-primary">
                  <img class="card-img-top" src="{{asset('img/'.$post->img)}}" alt="{{$post->title}}">
                  <div class="card-body">
                    <h4 class="card-title">{{$post->title}}</h4>
                    <p class="card-text">{{$post->body}}</p>
                  </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection