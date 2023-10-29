<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Price;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Room $rooms, IndexRoomRequest $request): RoomCollection
    {
        if ($request->hotel_id) {
            $hotel = Hotel::find();
        }

        $rooms = $rooms
            ->when(
                $request->has('hotel_id'),
                fn ($query) => $query->where('hotel_id', $hotel->id)
            )
            ->when(
                $request->has('total'),
                fn ($query) => $query->where('total', '>=', $request->total)
            )
            ->with('hotel')
            ->get();

        $rooms->each(
            function ($room, $key) use ($rooms, $request) {
                $final_date = $request->final_date ?? $request->initial_date;
                $prices = Price::where('room_id', $room->id)
                    ->whereBetween('date', [$request->initial_date, $final_date])
                    ->orderBy('date')
                    ->get();
                $rooms[$key]->prices = $prices;
            }
        );

        return RoomCollection::make($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, Room $rooms): JsonResponse
    {
        $rooms->create(
            $request->validated()
            + ['user_id' => $request->user()->id ]
        );

        return response()
            ->json(['message' => 'Room successfully created!'])
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): RoomResource
    {
        return RoomResource::make($room); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room): JsonResponse
    {
        $room->update($request->validated());

        return response()
            ->json(['message' => 'Room successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): JsonResponse
    {
        $room->delete();

        return response()
            ->json(['message' => 'Room successfully deleted']);
    }
}
