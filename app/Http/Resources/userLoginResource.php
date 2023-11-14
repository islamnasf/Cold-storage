<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class userLoginResource extends JsonResource
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
            'phone'=> $this->phone,
            'password'=> $this->password,
            'active'=> $this->active,
            'admin'=> $this->admin,
        ];
    }
}
