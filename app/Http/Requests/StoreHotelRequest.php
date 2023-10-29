<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'min:3', 'max:70', 'required'],
            'location' => ['string', 'max:40', 'required'],
            'image_url' => ['string', 'url:http,https', 'nullable'],
        ];
    }
}
