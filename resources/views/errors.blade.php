@if ($errors->any())
    <div class="alert alert-danger my-1">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li><strong>{{$error}}</strong></li>
            @endforeach
        </ul>
    </div>
@endif