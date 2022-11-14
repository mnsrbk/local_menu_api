<?php

namespace App\Http\Resources;

use App\Models\FoodIngredient;
use App\Models\Ingredient;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'image' => $this->getImage(),
            'thumb' => $this->getThumb(),
            'discount' => $this->discount ?: null,
            'discount_unit' => $this->discount_unit ?: null,
            'sizes' => SizeResource::collection($this->sizes),
            'ingredients' => IngredientResource::collection(FoodIngredient::whereFoodId($this->id)->get())
        ];
    }
}
