<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => ['string', 'exists:hotels,id', 'required'],
            'initial_date' => ['date_format:Y-m-d', 'required'],
            'final_date' => ['date_format:Y-m-d', 'after_or_equal:initial_date'],
            'total' => ['integer'],
        ];
    }
}
