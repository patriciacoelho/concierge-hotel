<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomCollection extends ResourceCollection
{
    public static $wrap = 'rooms';

    public function toArray($request)
    {
        return $this->resource->transform(fn (RoomResource $room) => [
            'id' => $room->id,
            'type' => $room->type,
            'total' => $room->total,
            'hotel' => $room->hotel,
            'prices' => optional($room->prices)->only([
                'id',
                'date',
                'value',
            ]),
        ]);
    }
}
