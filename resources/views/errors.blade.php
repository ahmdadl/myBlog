@if ($errors->{$errorBag ?? 'default'}->any())
    <div class="alert alert-danger my-1">
        <ul class="list-unstyled">
            @foreach ($errors->{$errorBag ?? 'default'}->all() as $error)
                <li><strong>{{$error}}</strong></li>
            @endforeach
        </ul>
    </div>
@endif