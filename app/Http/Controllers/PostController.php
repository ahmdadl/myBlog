<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index', [
            'posts' => Post::latest()->get(),
            'cats' => Category::latest()->get()
        ]);
    }

    public function search(string $title)
    {
        $title = urldecode($title);

        return view('post.index', [
            'posts' => Post::where('title', 'LIKE', "%{$title}%")
                ->get(),
            'cats' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : RedirectResponse
    {
        // validate inputs first
        $attr = $this->validateInputs();

        // upload image and store file name in database
        $attr['img'] = UploadImage::upload($request, 'img');

        $post = auth()->user()->createWithSlug($attr);

        return redirect($post->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // validate inputs first
        ['title' => $post->title,
        'body' => $post->body] = $this->validateInputs();

        // upload image and store file name in database
        $fileName = UploadImage::upload($request, 'img');
        if ($fileName !== null) {
            $post->img = $fileName;
        }

        $post->slug = Str::slug($post->title);

        $post->update();

        return redirect($post->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();

        return redirect('/posts');
    }

    private function validateInputs()
    {
        return request()->validate([
            'title' => 'required|string|min:10|max:70',
            'body' => 'required|string|min:50',
            'img' => 'nullable|image'
        ]);
    }
}
