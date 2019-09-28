@csrf
<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="title" id="title"
            placeholder="title" value="{{$post->title ?? ''}}">
    </div>
</div>
<div class="form-group row">
    <label for='body' class="col-form-legend col-sm-2">Content</label>
    <div class="col-sm-10">
        <textarea name='body' id='body' class='form-control'
            placeholder="Post Content"
            rows="7">{{$post->body ?? ''}}</textarea>
    </div>
</div>
<div class="form-group row">
        <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose Image</label>
              </div>
</div>
<div class="form-group row">
    <button type="submit"
        class="btn btn-primary btn-lg my-2 offset-sm-4">Save</button>
</div>