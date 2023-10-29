<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    public static $wrap = 'room';

    public function resolve($request = null): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'total' => $this->total,
            'hotel' => $this->hotel,
        ];
    }
}
