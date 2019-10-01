@extends('layouts.sidebar')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    @foreach ($category->posts as $post)
        <div class="card text-left col-sm-6">
          <img class="card-img-top" src="{{asset('storage/storage/img/'.$post->img)}}" alt="{{$post->title}}">
          <div class="card-body">
            <h4 class="card-title">{{$post->title}}</h4>
            <p class="card-text">{{$post->body}}</p>
          </div>
        </div>
    @endforeach
@endsection