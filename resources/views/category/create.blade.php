@extends('layouts.app')

@section('title')
    Create Ctaegory
@endsection

@section('content')
    <fieldset class='bg-dark text-light'>
        <legend class="text-info">Create New Category</legend>
        <form class="form form-horizontal" action="category" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="CategoryTitle">
              <small id="helpId" class="form-text text-muted">must be less than 10 characters</small>
            </div>
        </form>
    </fieldset>
@endsection