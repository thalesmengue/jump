<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceOrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'vehiclePlate' => ['required', 'string', 'max:7', 'min:7'],
            'entryDateTime' => ['required', 'date'],
            'exitDateTime' => ['required', 'date'],
            'priceType' => ['required'],
            'price' => ['required', 'numeric', 'gt:0']
        ];
    }
}
