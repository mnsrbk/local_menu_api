<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'name' => $this->ingredient->getTranslations('name') ?: null,
            'value' => $this->value,
            'unit' => $this->ingredient->getTranslations('unit') ?: null,
        ];
    }
}
