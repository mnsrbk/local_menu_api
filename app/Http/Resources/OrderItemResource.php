<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->size->food->getTranslations('name'),
            'size' => $this->size->getTranslations('name') ?: null,
            'quantity' => $this->quantity,
            'cost' => $this->total_cost,
        ];
    }
}
