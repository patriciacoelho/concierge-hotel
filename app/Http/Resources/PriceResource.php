<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    public static $wrap = 'price';

    public function resolve($request = null): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'value' => $this->value,
            'room' => $this->room,
        ];
    }
}
