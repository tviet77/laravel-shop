<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderCreateRequest extends FormRequest
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
            'title' => 'required|unique:sliders|string|max:255|min:5',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tên slider phải điền đầy đủ!',
            'title.unique' => 'Tên slider đã được sử dụng!',
            'title.string' => 'Tên slider phải là chuỗi!',
            'image_path.required' => 'Hình ảnh slider phải điền đầy đủ!',
            'description.required' => 'Nội dung slider phải điền đầy đủ!',
            'image_path.image' => 'Hình ảnh slider phải là hình ảnh!',
            'image_path.mimes' => 'Hình ảnh slider phải có đuôi jpeg, png, jpg, gif, svg!',
        ];
    }
}
