<b-modal centered size='lg' id="post-form" title="Create New Post"
    header-text-variant='danger'>
    <b-container fluid>
        <form class="form needs-validation" :class='createForm' novalidate>
            <div class="row mb-1 text-center">
                <div class="col-6">
                    <h5 class="text-primary">
                        Create Post</h5>
                    <div class="form-group">
                        <input type="text" v-model="ptitle" id="ptitle"
                            class="form-control col-12"
                            placeholder="post title"
                            aria-describedby="helpId" minlength="10"
                            maxlength="255" required>
                        <div id="helpId" class="invalid-feedback">
                            must
                            be
                            longer than 10
                            chars</div>
                        <div class="valid-feedback">
                            looks fine
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea type="text" v-model="body" id="body"
                            class="form-control" placeholder="post body"
                            aria-describedby="helId" rows='5'
                            minlength="50" required></textarea>
                        <small id="helId" class="text-muted">must
                            be
                            longer than 50
                            character</small>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="text-info">
                        Add some tasks</h5>
                    <div class="form-group">
                        <input type="text" class="form-control"
                            v-model="taskBody" id="taskBody"
                            aria-describedby="helpId"
                            placeholder="task body">
                    </div>
                </div>
            </div>
        </form>
    </b-container>
    <template v-slot:modal-footer>
        <div class="w-100">
            <p class="float-left">copy&copy;ninjaCoder
            </p>
            <b-button variant="success" {{-- size="sm" --}}
                class="float-right" v-on:click.stop.prevent="savePost()">
                Save
            </b-button>
            <b-button variant='danger' class="float-right mr-2"
                v-on:click.stop.prevent='$bvModal.hide("post-form")'>
                Close</b-button>
        </div>
    </template>
</b-modal>
