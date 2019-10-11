@extends('layouts.app')

@section('title')
{{$post->title}}
@endsection

@section('content')
<div class=''>
    @include('errors')
    @if ($post->activities->count() > 0)
    <div class="card bg-dark d-block col-12">
            <div class="card-title bg-dark text-light p-2 ml-3 d-block">
                @foreach ($post->activities as $activity)
                    <span class="text-danger">
                        {{$activity->owner->name}}
                    </span>
                    <span class="text-warning">
                        {{$activity->info}}
                    </span>
                    <span class="text-muted">
                        {{$activity->updated_at->diffForHumans()}}
                    </span>
                    <br />
                @endforeach
            </div>
        </div>
    @endif
    @include('post.addCategory')
    <div class="bg-dark text-light text-center m-2 p-3">
        <fieldset class="">
            <legend>Add new Member</legend>
            <form class="form" action="{{$post->path() . '/invite'}}"
                method="POST">
                @csrf
                <input type="email" name="userEmail"
                    placeholder="user email" class="form-control" />
            </form>
        </fieldset>
    </div>

    <div class="card">
        <img class="card-img-top"
            src="{{asset('storage/storage/img/'.$post->img)}}" alt="">
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
                <small class="d-block mt-2">
                    @foreach ($post->members as $member)
                    <a href="/users/{{$member->id}}"
                        class="btn btn-danger btn-sm text-light">
                        {{$member->name}}
                    </a>
                    @endforeach
                </small>
                <p class="py-1">{{$post->title}}</p>
                <div class="text-center" style="direction: rtl;">
                    <a href="/users/{{$post->owner->id}}"
                        class="btn btn-outline-danger">
                        {{$post->owner->name}} <span
                            class="text-muted">{{$post->updated_at->diffForHumans()}}</span>
                    </a>
                </div>
            </h4>
            <p class="card-text">{{$post->body}}</p>
        </div>
        @include('post.opr')
    </div>
    @include('post.task')
    @include('post.comment.index')
</div>
@endsection