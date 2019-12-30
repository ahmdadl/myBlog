<?php

namespace App\Http\Controllers;

use App\Post;
use App\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(
        Request $request,
        Post $post
    ) {
        $this->authorize('updateCategory', $post);

        $task = $post->addTask(
            request()->validate([
                'body' => 'required|min:5|max:70'
            ])['body']
        );

        if (request()->wantsJson()) {
            return $task;
        }

        return back();
    }

    public function update(
        Request $request,
        Post $post,
        Task $task
    ) : RedirectResponse {
        $this->authorize('update', $post);

        (null !== request('done')) ? $task->complete() : $task->unComplete();

        if (request()->wantsJson()) {
            return json_encode(['done' => true]);
        }
        
        return back();
    }
}
