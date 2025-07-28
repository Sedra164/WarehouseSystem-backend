<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'warehouse'   =>$this->warehouse->name??null,
            'product'     =>$this->product->name??null,
            'quantity'    =>$this->quantity,
            'min_quantity'=>$this->min_quantity,
        ];
    }
}
