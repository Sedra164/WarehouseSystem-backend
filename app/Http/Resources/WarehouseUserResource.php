<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_name'     =>$this->user?->full_name,
            'user_email'    =>$this->user?->email,
            'warehouse_name'=>$this->warehouse?->name,
            'type'          =>$this->type,
        ];
    }
}
