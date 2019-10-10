<div class="col-12 mt-4">
    @include('post.comment.form')
    <ul class="list-unstyled mt-3">
        @foreach ($post->comments as $comment)
        <li class="media {{ $loop->last ?: 'mb-4' }}">
            <img src="{{asset('img/user.png')}}" class="mr-3 rounded"
                alt="{{$comment->owner->name}}" width="150" height="100">
            <div class="media-body">
                <h5 class="mt-0 mb-1 text-primary">
                    {{$comment->owner->name}}
                </h5>
                {{$comment->body}}
            </div>
        </li>
        @endforeach
    </ul>
</div>