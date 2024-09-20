<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            "id"  => "required|exists:categories,id",
            "category_name" => "required|min:5|max:30",
            "status"      => "required|boolean",
            //
        ];
    }
    public function messages()
    {
        return [
            "id.*" =>  " danh mục không tồn tại!",
            "category_name.required" =>  "Yêu cầu nhập danh mục!",
            "category_name.min"      => "Yêu cầu ít nhất 5 ký tự",
            "category_name.max"     => "Yêu cầu tối đa 30 ký tự!",
            "status.*"             => "Vui lòng chọn trình trạng!",
        ];
    }

}
