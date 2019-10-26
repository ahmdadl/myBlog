<div class="bg-dark text-secondary rounded-lg p-2 my-3" v-if='post'>
    <ul class="list-unstyled">
        <li class="media my-3 p-1" v-for='comment in post.comments'>
            <a class="d-flex text-danger" :href="'/users/' + comment.owner.id">
                <img src="{{asset('img/user.png')}}" class="img-responsive img" :alt="comment.owner.name" width="130" />
            </a>
            <div class="media-body ml-2">
                <span class="text-xl text-danger">@{{comment.owner.name}}</span>
                    
                    <small class="text-muted" dir="ltr">@{{comment.created}}</small>
                <span class="d-block">
                    @{{comment.body}}
                    <button type="button" class="btn btn-outline-info btn-sm text-capitalize">replay</button>
                </span>
            </div>
        </li>
      </ul>
</div>