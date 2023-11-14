<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TermResource extends JsonResource
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
            'start'=> $this->start,
            'end'=> $this->end,
            'user_id'=> $this->user_id,
        ];
    }
}
