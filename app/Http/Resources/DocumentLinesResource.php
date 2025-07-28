<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentLinesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'document_type'=>$this->document->type??null,
            'quantity'     =>$this->quantity,
            'unit_price'   =>$this->unit_price,
            'totalPrice'   =>$this->total_price,
        ];
    }
}
