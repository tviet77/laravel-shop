<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name' => 'required|unique:products|string|max:255|min:5',
            'price' => 'required|numeric',
            'product_category_id' => 'required',
            'content' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống!',
            'name.unique' => 'Tên sản phẩm đã được sử dụng!',
            'name.string' => 'Tên sản phẩm phải là chuỗi!',
            'price.required' => 'Giá sản phẩm không được để trống!',
            'price.numeric' => 'Giá sản phẩm phải là số!',
            'product_category_id.required' => 'Danh mục sản phẩm không được để trống!',
            'content.required' => 'Nội dung sản phẩm được điền!',
        ];
    }
}
