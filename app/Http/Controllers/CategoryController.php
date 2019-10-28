<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : RedirectResponse
    {
        $title = request()->validate([
            'title' => 'required|string|min:3|max:20'
        ]);

        Category::create($title);

        return redirect('/posts');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = DB::table('post_categories')
            ->join('posts', 'post_categories.post_id', '=', 'posts.id')
            ->where('post_categories.category_id', '=', $category->id)
            ->select('post_categories.*', 'posts.*')
            ->paginate(15);

        return view('post.index', [
            'posts' => $posts,
            'cats' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
