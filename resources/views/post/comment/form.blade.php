<div class="bg-dark text-light">
    <fieldset class="p-2">
        <legend class="text-primary">Create New Comment</legend>
        <form action="{{$action}}" method="POST" class="form">
            @csrf
            <div class="form-group">
              <label for="body">Comment</label>
              <textarea class="form-control" name="body" id="body" rows="4" placeholder="Write Your Comment"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Comment</button>
            </div>
        </form>
    </fieldset>
</div>