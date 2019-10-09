@can('updateCategory', $post)
    <div class="bg-primary text-white p-3 m-2">
        <form action="{{$post->path()}}/addCategory" method="POST" class="form" id="addCategoryFoem">
                @csrf
                <div class="form-group">
                  <label for="catId">Add Category</label>
                  <select class="form-control" name="catId" id="catId" onchange="document.getElementById('addCategoryFoem').submit()">
                        @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">
                            {{$cat->title}}
                        </option>
                    @endforeach
                  </select>
                </div>
            </form>
    </div>
@endcan