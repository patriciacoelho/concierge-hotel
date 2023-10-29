<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PriceCollection extends ResourceCollection
{
    public static $wrap = 'prices';

    public function toArray($request)
    {
        return $this->resource->transform(fn (PriceResource $price) => [
            'id' => $price->id,
            'date' => $price->date,
            'value' => $price->value,
            'room' => $price->room,
            'updated_at' => $price->updated_at->format('Y-m-d'),
        ]);
    }
}
