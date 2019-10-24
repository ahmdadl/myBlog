<?php

namespace App\Http\Resources;

use App\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {        
        return [
            'data' => $this->collection,
            'links' => 'link-1'
        ];
    }
}
