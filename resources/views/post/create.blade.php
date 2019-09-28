@extends('layouts.app')

@section('title')
    Create New Post
@endsection

@section('content')
    <div class="container">
        <form action="/posts" method="POST" class="form">
            @include('post.form')
        </form>
    </div>
    @include('errors')
@endsection