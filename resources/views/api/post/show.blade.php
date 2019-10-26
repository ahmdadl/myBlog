@extends('layouts/api')

@section('title')
post
@endsection

@section('content')
<div class="row" v-if='post'>
    {{-- Activities START --}}
    <div v-if='post.activities'
        class="bg-dark text-info border-light rounded pt-2 mb-2 col-12">
        <ul>
            <li v-for='act in post.activities'>
                <span class="text-warning" v-text='act.owner'></span>
                <span class="text-primary" v-text='act.info'></span>
                <span class="text-muted" v-text='act.update_at'></span>
            </li>
        </ul>
    </div>
    {{-- Activities END --}}

    <div class="col-12 jumbotron jumbotron-fluid bg-dark text-light mb-3"
        :style="'background: url({{asset("storage/storage/img/")}}/' + post.img +') no-repeat top left;background-size: cover'">
        <div class="container">
            <h6 class="bg-dark rounded-lg p-2">
                <a href='/api/posts' class="text-warning">Posts</a> /
                <span class="text-muted">@{{post.title}}</span>
            </h6>
            <h1 class="display-3">@{{post.title}}</h1>
            <p class="lead">you can see all posts with loggin in</p>
            <hr class="my-2">
            <p>More info</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="Jumbo action link"
                    role="button">DoNothing</a>
            </p>
        </div>
    </div>
</div>

<div class="container" v-if='post'>
    <div class="row">
        <div class="card bg-dark text-light col-12 col-sm-10 col-md-8 p-0">
            <img class="card-img-top"
                :src="'{{asset('storage/storage/img')}}/' + post.img" />
            <div class="card-body">
                <small class='card-title btn btn-outline-danger btn-sm'>By
                    @{{post.owner.name}}
                </small>
                <hr />
                <span v-for='cat in post.cats'
                    class="badge badge-primary rounded-pill m-1">@{{cat.title}}</span>
                <hr />
                <div class="card-text">
                    @{{post.body}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tasks START --}}
@include('api.post.tasks')

@include('api.post.comment')

<div v-if='!post'
    class="container-fluid bg-dark text-danger text-center postLoader">
    AnimateBeforeLoading
</div>
@endsection