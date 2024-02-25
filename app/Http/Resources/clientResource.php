<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class clientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $data = parent::toArray($request);
        // $data = array_map(function ($value) {
        //     return $value === null ? 0 : $value;
        // }, $data);
        return  [
            'id'=> $this->id,
            'name'=> $this->name,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'vegetable_name'=> $this->vegetable_name,
            'fridge_name'=> $this->fridge, 
           // 'amber_details'=> AmberResource::make($this->ambers),
            'fridge_details'=> FridgeResource::make($this->fridges),
            'price_list'=> PriceResource::make($this->price_lists),
            'term_details'=> TermResource::make($this->terms),
            'data'=>$data
        ];
        //return $data;
    }
}
