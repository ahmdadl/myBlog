<div class="mt-3">
    <b-button v-on:click.stop='$bvModal.show("post-edit" + post.id)' variant='info'>Edit
        Post</b-button>
    <edit-post :id='"post-edit" + post.id' :post-data='post' is-post='{{$isPost ?? false}}' :post-indx='postIndx || 0'></edit-post>

    <button type="button" class="btn btn-outline-danger"
        v-on:click="deletePost(post.slug, {{$isPost ?? 'false'}}, postIndx || 0)">
        <span :ref="'delPost' + postIndx" class="d-none">
            <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
            ></span>
        </span>
        Delete<span v-if='postDeleteing'>ing</span>
    </button>
</div>