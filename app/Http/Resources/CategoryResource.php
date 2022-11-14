<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $food_query = $this->foods()->whereIsActive(true);

        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'image' => $this->getImage(),
            'thumb' => $this->getThumb(),
            'subcategories' => $this->collection($this->children),
            'is_drink' => $this->is_drink ? true : false,
            'foods' => FoodResource::collection($food_query->get()),
        ];
    }
}
