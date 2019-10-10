<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(
        Request $request,
        Post $post
    ) : RedirectResponse {
        $this->authorize('updateCategory', $post);

        $post->addTask(
            request()->validate([
                'body' => 'required|min:5|max:70'
            ])['body']
        );

        return back();
    }
}
