<ul class="list-unstyled mt-3">
    <li v-for='comment in post.comments' class="media mb-4">
        <img src="{{asset('img/user.png')}}" class="mr-3 rounded border border-primary"
            :alt="post.owner.name" width="150" height="100">
        <div class="media-body">
            <h5 class="mt-0 mb-1 text-primary">
                <span class="d-inline">@{{post.owner.name}}</span>
                <form action="" method='POST' class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger"><strong>&times;</strong></button>
                </form>
            </h5>
            @{{comment.body}}
                <div class="replayForm d-none">
                    @include('post.comment.form', [
                    'action' => ''
                    ])
                </div>
            </ul>
        </div>
    </li>
</ul>