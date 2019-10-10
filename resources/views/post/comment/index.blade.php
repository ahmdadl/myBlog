@foreach ($post->comments as $comment)
    {{$comment->body}}<br>
@endforeach