@extends('layouts.app')

@section('title')
    all posts
@endsection

@section('content')
    <div class="row ml-2">
        @forelse ($posts as $post)
            <div class='card col-sm-6 col-md-4 col-lg-3 p-0 shadow'>
                <div class="card border-primary">
                  <img class="card-img-top" src="{{asset('img/'.$post->img)}}" alt="{{$post->title}}">
                  <div class="card-body">
                    <h4 class="card-title">
                        <a href='/posts/{{$post->slug}}' class="">
                            {{$post->title}}
                        </a>
                    </h4>
                    <p class="card-text">{{$post->mini_body}}</p>
                  </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning m-auto" style="width:50%">
                <b>Note:</b> no posts has been added yet
            </div>
        @endforelse
    </div>
@endsection