<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'vegetable_name'=> $this->vegetable_name,
            'ton'=>$this->ton,
            'small_shakara'=> $this->small_shakara,
            'big_shakara'=> $this->big_shakara,
            'user_name'=> UserResource::make($this->users),
        ];
    }
}
