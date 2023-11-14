<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FridgeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'size'=> $this->size,
            'user_id'=> $this->user_id,
            'ambers'=> AmberResource::collection($this->ambers),
            'owner'=> UserResource::make($this->users),
        ];
    }
}
