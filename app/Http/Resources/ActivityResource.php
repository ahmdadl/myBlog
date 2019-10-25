<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'owner' => $this->owner->name,
            'info' => $this->info,
            'updated_at' => $this->updated_at->diffForHumans()
        ];
    }
}
