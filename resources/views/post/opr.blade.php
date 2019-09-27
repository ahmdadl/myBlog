@can ('update', $post)
    <div class="card-footer text-center text-light bg-secondary">
        <a href="{{$post->path() . '/edit'}}" class="btn btn-info">Edit</a>
        <form class="d-inline" action="{{$post->path()}}" method='POST'>
            @method('DELETE')
            @csrf
            <button type='submit' class='btn btn-danger'>Delete</button>
        </form>
    </div>
@endcan