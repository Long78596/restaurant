<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
            'full_name'            => 'nullable',
            'middle_name'         => 'required',
            'phone_number'     => 'required|numeric',
            'email'             => 'nullable',
            'note'           => 'nullable',
            'birth_date'         => 'nullable',
            'tax_code'        => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'full_name.*'         => 'Tên Khách hông được để trống!',
            'phone_number.*'     => 'Số điện thoại Không được để trống!',
        ];
    }
}
