<style>
    .checkedTask {
        text-decoration: line-through;
    }
</style>
<div class="mt-4">
    <div class="col-12 bg-dark text-warning p-3">
        <h4 class="text-info">Tasks</h4>
        <form action="{{$post->path() . '/tasks'}}" method="POST"
            class="form mb-2">
            @csrf
            <div class="form-group text-info">
                <input type="text" class="form-control" name="body"
                    id="body" aria-describedby="helpId"
                    placeholder="your task">
                <small id="helpId" class="form-text text-muted">less than
                    70 character</small>
            </div>
        </form>
        @foreach ($post->tasks as $task)
        <form action='{{$task->path()}}' method='POST' class='form'
            id='completeTask{{$task->id}}'>
            @method('PATCH')
            @csrf
            <div class="form-group">
                <div class="form-check form-check-inline {{!$task->done ?: 'checkedTask text-danger'}}"
                    onclick="setTimeout(_ => document.getElementById('completeTask{{$task->id}}').submit(), 50);">
                    <label
                        class="form-check-label {{ $task->done ? 'checked' : ''}}">
                        <input class="form-check-input" type="checkbox"
                            name="done" id="done" value="{{$task->id}}" {{!$task->done ?: 'checked'}}> {{$task->body}}
                    </label>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>