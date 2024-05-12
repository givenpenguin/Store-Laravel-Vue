<?php

namespace App\Http\Requests\Product;

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
            'title' => 'required|string',
            'article' => 'required|string',
            'description' => 'nullable|string',
            'preview_image' => 'required|file',
            'product_images' => 'nullable|array',
            'price' => 'required|float',
            'discount' => 'nullable|float',
            'quantity' => 'required|integer',
            'category_id' => 'required|integer',
            'sizes' => 'required|array',
        ];
    }
}
