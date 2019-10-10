<ul class="list-unstyled">
    @foreach ($post->comments as $comment)
    <li class="media {{ $loop->last ?: 'mb-4' }}">
        <img src="{{asset('img/user.png')}}" class="mr-3"
            alt="{{$comment->owner->name}}">
        <div class="media-body">
            <h5 class="mt-0 mb-1">
                {{$comment->owner->name}}
            </h5>
            {{$comment->body}}
        </div>
    </li>
    @endforeach
</ul>