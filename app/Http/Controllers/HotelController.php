<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\HotelCollection;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HotelCollection
    {
        $hotels = Hotel::orderBy('name')->get();

        return HotelCollection::make($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request, Hotel $hotels): JsonResponse
    {
        $hotels->create(
            $request->validated()
            + ['user_id' => $request->user()->id ]
        );

        return response()
            ->json(['message' => 'Hotel successfully created!'])
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel): HotelResource
    {
        return HotelResource::make($hotel); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel): JsonResponse
    {
        $hotel->update($request->validated());

        return response()
            ->json(['message' => 'Hotel successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel): JsonResponse
    {
        $hotel->delete();

        return response()
            ->json(['message' => 'Hotel successfully deleted']);
    }
}
