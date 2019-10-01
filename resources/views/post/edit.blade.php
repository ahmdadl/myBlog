@extends('layouts.app')

@section('title')
    update Post {{$post->title}}
@endsection

@section('content')
<div class="container">
    <form action="{{$post->path()}}" method="POST" class="form" enctype="multipart/form-data">
        @method('PATCH')
        @include('post.form', compact('post'))
    </form>
</div>
@include('errors')
@endsection