<div class="mt-3">
    <b-button v-b-modal.post-edit variant='info'>Edit
        Post</b-button>
    <edit-post id='post-edit' :post-data='post'></edit-post>
    
    <button type="button" class="btn btn-outline-danger"
        v-on:click="deletePost(post.slug, {{$isPost}})">
        <span v-if="postDeleteing">
            <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
            ></span>
        </span>
        Delete<span v-if='postDeleteing'>ing</span>
    </button>
</div>