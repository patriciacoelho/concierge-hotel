<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['date', 'required'],
            'value' => ['numeric', 'required'],
            'room_id' => ['integer', 'required'],
        ];
    }
}
