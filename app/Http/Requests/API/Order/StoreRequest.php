<?php

namespace App\Http\Requests\API\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'required|array',

            'full_name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'building' => 'required|string',
            'flat' => 'nullable|string',
            'postal_code' => 'nullable|string',

            'comment' => 'nullable|string',

            'delivery_method' => 'required|string',
            'payment_method' => 'required|string',

            'amount_of_products' => 'required|numeric',
            'amount_of_discount' => 'required|numeric',
            'amount_of_delivery' => 'required|numeric',

            'total_price' => 'required|numeric',
        ];
    }
}
