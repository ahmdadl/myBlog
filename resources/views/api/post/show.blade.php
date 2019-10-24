@extends('layouts/api')

@section('title')
post
@endsection

@section('content')
<div class="row" v-if='post'>
    <div class="col-12 jumbotron jumbotron-fluid bg-dark text-light mb-3"
        style="background: url('{{asset('storage/storage/img/5.png')}}') no-repeat top left;background-size: cover">
        <div class="container">
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
                <small class='card-title btn btn-outline-danger btn-sm'>By @{{post.owner.name}}
                </small>
                <hr />
                <span v-for='cat in post.cats' class="badge badge-primary rounded-pill m-1">@{{cat.title}}</span>
                <hr />
                <div class="card-text">
                    @{{post.body}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @include('api.comments.index') --}}

<div v-if='!post' class="container-fluid bg-dark text-danger text-center postLoader">
    AnimateBeforeLoading
</div>
@endsection