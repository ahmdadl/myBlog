<div class="bg-dark text-secondary rounded-lg p-2 my-3" v-if='post'>
    <form class="form mb-3 needs-validation" :class='{"was-validated": comErr}'
        method="POST" novalidate @submit.stop.prevent='addComment(post.slug)'>
        <div class="form-group">
            <h6 class="text-info text-capitalize">add new comment</h6>
        </div>
        <div class="form-group">
            <textarea class="form-control" v-model="newComment" id="newComment"
                rows="4" placeholder="write your comment" minlength="25"
                maxlength="350" aria-describedby="descThis" required></textarea>
            <div id="descThis" class="invalid-feedback" v-if='comErr'
                v-text='comErr'></div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-info">
                <span v-if="commentSaving">
                    <span class="spinner-border spinner-border-sm text-light"
                        role="status" aria-hidden="true"></span>
                </span>
                Comment
            </button>
        </div>
    </form>

    <hr class="bg-info p-1" />

    <ul class="list-unstyled">
        <li class="media my-3 p-1" :ref='"com" + comment.id' v-for='comment in post.comments'>
            <a class="d-flex text-danger" :href="'/users/' + comment.owner.id">
                <img src="{{asset('img/user.png')}}" class="img-responsive img"
                    :alt="comment.owner.name" width="130" />
            </a>
            <div class="media-body ml-2">
                <span class="text-xl text-danger">@{{comment.owner.name}}</span>

                <small class="text-muted" dir="ltr">@{{comment.created}}</small>
                <span class="d-block">
                    @{{comment.body}}
                    <button type="button"
                        class="btn btn-outline-info btn-sm text-capitalize">replay</button>
                </span>
            </div>
        </li>
    </ul>
</div>