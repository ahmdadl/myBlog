<div class="card my-4 border-danger shadow">
    <h5 class="card-header text-white bg-danger">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @forelse ($cats as $c)
                    <li>
                        <a href="/category/{{$c->id}}" class="btn btn-outline-primary">
                            {{$c->title}}
                        <span class="badge badge-info">
                            {{$c->posts->count()}}
                        </span>
                        </a>
                    </li>
                    @empty
                        <span><strong class="text-danger">
                            No Categories</strong></span>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>