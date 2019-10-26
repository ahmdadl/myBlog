@extends('layouts/api')

@section('title')
All Posts
@endsection

@section('content')
<div class="row">
    <div class="col-12 jumbotron jumbotron-fluid bg-dark text-light mb-3"
        style="background: url('{{asset('storage/storage/img/3.png')}}') no-repeat top left;background-size: cover">
        <div class="container">
            <h1 class="display-3">All Posts</h1>
            <p class="lead">you can see all posts with loggin in</p>
            <hr class="my-2">
            <p>More info</p>
            <p class="lead">
                <div>
                    <b-button v-b-modal.post-form variant='info'>Create
                        Post</b-button>

                    <post-modal id='post-form' :all-posts='posts'></post-modal>

                </div>
            </p>
        </div>
    </div>
</div>

<div v-if='!posts' class="text-center">
    <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"
        role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="card col-12 col-sm-6 col-md-4 col-lg-3 m-2 p-0"
            v-for='(post, postIndx) in posts' :key='post.id'>
            <img class="card-img-top"
                :src="'{{asset('storage/storage/img')}}/' + post.img" />
            <div class="card-body">
                <a class='card-title' :href="'/api/posts/' + post.slug">
                    <h4>@{{post.title}}</h4>
                </a>
                <p class="card-text">
                    @{{post.body.substr(0, 250)}}
                    <br>
                    @include('api.post.opr')
                </p>
            </div>
        </div>
    </div>
</div>
@endsection