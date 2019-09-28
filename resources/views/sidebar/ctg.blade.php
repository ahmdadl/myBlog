<div class="card my-4 border-danger shadow">
    <h5 class="card-header text-white bg-danger">Categories</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                    @foreach ($cats as $c)
                    <li>
                        <a href="/category/{{$c->id}}">
                            {{$c->title}}
                        <span class="badge badge-primary">
                            {{$c->posts->count()}}
                        </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>