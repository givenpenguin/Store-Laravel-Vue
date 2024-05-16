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
            'preview_image' => 'required|file|mimes:jpeg,png,jpg,svg',
            'product_images.*' => 'nullable|file|mimes:jpeg,png,jpg,svg',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|integer',
            'sizes' => 'required|array',
            'quantities' => 'required|array',
        ];
    }
}
