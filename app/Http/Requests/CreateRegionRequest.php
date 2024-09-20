<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegionRequest extends FormRequest
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
            "region_name" => "required|min:5|max:30",
            "region_slug" => "required|min:5|max:30",
            "status"      => "required|boolean",
            //
        ];
    }
    public function messages(){
        return [
            "region_name.required" =>  "Yêu cầu nhập khu vực!",
            "region_name.min"      => "Yêu cầu ít nhất 5 ký tự",
            "region_name.max"     => "Yêu cầu tối đa 30 ký tự!",
            "region_slug.required" =>  "Yêu cầu nhập khu vực!",
            "region_slug.min"      => "Yêu cầu ít nhất 5 ký tự!",
            "region_slug.max"     => "Yêu cầu tối đa 30 ký tự!",
            "status.*"             => "Vui lòng chọn trìng trạng!",
        ];
    }
}
