<?php

namespace App\Http\Resources;

use App\Activity;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'img' => $this->img,
            'updated_at' => $this->updated_at,
            'owner' => $this->owner,
            'cats' => $this->categories->all(),
            'tasks' => $this->tasks->all(),
            'comments' => $this->getComments(),
            'activities' => $this->getActivities()
        ];
    }

    private function getActivities() : array
    {
        $arr = [];

        foreach ($this->activities()->latest()->get() as $activity) {
            $activity->owner = User::find($activity->userId)->name;
            $activity->update_at = $activity->updated_at->diffForHumans();

            $arr[] = $activity;
        }

        return $arr;
    }

    private function getComments() : array
    {
        $arr = [];

        foreach ($this->comments()->latest()->get() as $comment) {
            $comment->owner = User::find($comment->userId);
            $comment->created = $comment->created_at->diffForHumans();
            $arr[] = $comment;
        }

        return $arr;
    }
}
