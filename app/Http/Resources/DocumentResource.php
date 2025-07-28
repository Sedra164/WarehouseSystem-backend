<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type'      =>$this->type,
            'notes'     =>$this->notes,
            'date'      =>$this->date,
            'partner'   => $this->partner->name??null,
            'warehouse' => $this->warehouseUser?->warehouse?->name,
            'employee'  => $this->warehouseUser?->user?->full_name,
            'product'   => $this->warehouseProduct?->product?->name,
        ];
    }
}
