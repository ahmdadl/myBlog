<div class="col-12 mt-4">
    @include('post.comment.form', [
    'action' => $post->path() . '/comments'
    ])
    <ul class="list-unstyled mt-3">
        @foreach ($post->comments as $comment)
        <li class="media {{ $loop->last ?: 'mb-4' }}">
            <img src="{{asset('img/user.png')}}" class="mr-3 rounded border border-primary"
                alt="{{$comment->owner->name}}" width="150" height="100">
            <div class="media-body">
                <h5 class="mt-0 mb-1 text-primary">
                    <span class="d-inline">{{$comment->owner->name}}</span>
                    <form action="{{$comment->path()}}" method='POST' class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger"><strong>&times;</strong></button>
                    </form>
                </h5>
                {{$comment->body}}
                <button type="button"
                    class="btn btn-outline-primary ml-3 showReplayForm">Replay</button>
                <ul class="list-unstyled mt-1">
                    @foreach ($comment->replays as $replay)
                    <li class="media {{ $loop->last ?: 'mb-4' }}">
                        <img src="{{asset('img/user.png')}}"
                            class="mr-3 rounded border border-danger"
                            alt="{{$replay->owner->name}}" width="110"
                            height="70">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1 text-danger">
                                {{$replay->owner->name}}
                            </h5>
                            {{$replay->body}}
                        </div>
                    </li>
                    @endforeach
                    <div class="replayForm d-none">
                        @include('post.comment.form', [
                        'action' => $comment->path()
                        ])
                    </div>
                </ul>
            </div>
        </li>
        @endforeach
    </ul>
</div>