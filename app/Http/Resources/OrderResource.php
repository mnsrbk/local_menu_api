<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'code' => '#' . $this->code,
            'created_at' => date('h:i/d.m.Y', strtotime($this->created_at)),
            'cost' => $this->cost,
            'service_cost' => $this->service_cost,
            'total_cost' => $this->total_cost,
            'items' => OrderItemResource::collection($this->items)
        ];
    }
}
