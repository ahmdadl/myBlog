@extends('layouts.base')

@section('baseContent')
   <div class="row">
    <div class="col-sm-8 col-md-9">
        @yield('content')
    </div>
    <div class="col-sm-4 col-md-3">
        @include('sidebar.index')
    </div>
   </div>
@endsection