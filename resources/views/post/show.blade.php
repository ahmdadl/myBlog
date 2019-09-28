@extends('layouts.app')

@section('title')
{{$post->title}}
@endsection

@section('content')
<div class='row'>
    <div class="card text-left">
        <img class="card-img-top" src="{{asset('img/'.$post->img)}}"
            alt="">
        <div class="card-body">
            <h4 class="card-title">
                <small>
                    @foreach ($post->categories as $c)
                    <a href="/category/{{$c->id}}"
                        class="btn btn-info btn-sm text-light">
                        {{$c->title}}
                    </a>
                    @endforeach
                </small>
                <p class="py-1">{{$post->title}}</p>
                <div class="text-center">
                    <a href="/users/{{$post->owner->id}}"
                        class="btn btn-outline-danger">By
                    {{$post->owner->name}} <span class="text-muted">{{$post->updated_at->diffForHumans()}}</span>
                    </a>
                </div>
            </h4>
            <p class="card-text">{{$post->body}}</p>
        </div>
        @include('post.opr')
    </div>
</div>
@endsection