<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Http\Resources\PriceCollection;
use App\Http\Resources\PriceResource;
use App\Models\Price;
use Illuminate\Http\JsonResponse;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): PriceCollection
    {
        $prices = Price::paginate(30);

        return PriceCollection::make($prices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceRequest $request, Price $prices): JsonResponse
    {
        $prices->create(
            $request->validated()
            + ['user_id' => $request->user()->id ]
        );

        return response()
            ->json(['message' => 'Price successfully created!'])
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price): PriceResource
    {
        return PriceResource::make($price); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriceRequest $request, Price $price): JsonResponse
    {
        $price->update($request->validated());

        return response()
            ->json(['message' => 'Price successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price): JsonResponse
    {
        $price->delete();

        return response()
            ->json(['message' => 'Price successfully deleted']);
    }
}
