@extends('layouts.app')

@section('title')
    Create New Post
@endsection

@section('content')
    <div class="container">
        <form action="/posts" method="POST" class="form">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title" placeholder="title">
                </div>
            </div>
            <div class="form-group row">
                <label for='body' class="col-form-legend col-sm-2">Content</label>
                <div class="col-sm-10">
                    <textarea name='body' id='body' class='form-control' placeholder="Post Content" rows="7"></textarea>
                </div>
            </fieldset>
            <div class="form-group row">
                <button type="submit" class="btn btn-primary btn-lg my-2 offset-sm-4">Save</button>
            </div>
        </form>
    </div>
@endsection