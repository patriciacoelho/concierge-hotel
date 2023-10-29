<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelCollection extends ResourceCollection
{
    public static $wrap = 'hotels';

    public function toArray($request)
    {
        return $this->resource->transform(fn (HotelResource $hotel) => [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'location' => $hotel->location,
            'image_url' => $hotel->image_url,
            'updated_at' => $hotel->updated_at->format('Y-m-d'),
        ]);
    }
}
