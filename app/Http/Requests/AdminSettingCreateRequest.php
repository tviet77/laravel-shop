<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingCreateRequest extends FormRequest
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
            'config_key' => 'required|unique:admin_settings,config_key,NULL,id,deleted_at,NULL|max:255',
            'config_value' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'config_key.required' => 'Config key không được để trống',
            'config_key.unique' => 'Config key đã tồn tại',
            'config_value.required' => 'Config value không được để trống',
        ];
    }
}
