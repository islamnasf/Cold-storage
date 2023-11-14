<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmberResource extends JsonResource
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
            'fridge_id'=> $this->fridge_id,
            'fridge'=>FridgeAmberResource::make($this->fridges),

        ];
    }
}
