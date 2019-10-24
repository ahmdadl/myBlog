<?php

namespace App\Http\Resources;

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
            'comments' => $this->comments->all()
        ];
    }
}
