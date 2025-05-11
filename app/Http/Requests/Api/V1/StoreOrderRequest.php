<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.amount' => 'required|numeric',
            'data.relationships.drinks.data.id' => 'required|integer|exists:drinks,id',
            'data.relationships.extras.data' => 'required|array',
            'data.relationships.extras.data.*.id' => 'required|integer|exists:extras,id',
        ];
    }

    public function messages(): array
    {
        return [
            'data.attributes.amount' => 'The data.attributes.amount field is required.',
        ];
    }
}
