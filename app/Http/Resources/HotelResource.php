<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    public static $wrap = 'hotel';

    public function resolve($request = null): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location' => $this->location,
            'image_url' => $this->image_url,
        ];
    }
}
