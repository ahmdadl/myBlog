@extends('layouts.app')

@section('title')
    update Post {{$post->title}}
@endsection

@section('content')
<div class="container">
    <form action="{{$post->path()}}" method="POST" class="form">
        @method('PATCH')
        @include('post.form', compact('post'))
    </form>
</div>
@endsection