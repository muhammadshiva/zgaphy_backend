<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|min:3|unique:products,name',
            'description' => 'nullable',
            'price' => 'required|integer',
            'category' => 'required|in:motobike,helmet,apparel,fnb,additional',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
