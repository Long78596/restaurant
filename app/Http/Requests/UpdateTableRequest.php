<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
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
            'id'                =>  'required|exists:tables,id',
            'table_name'           =>  'required|min:5|max:30',
            'table_slug'          =>  'required|min:5|unique:tables,table_slug, ' . $this->id,
            'opening_price'          =>  'required|numeric|min:0',
            'hourly_rate'        =>  'required',
            'region_id'        =>  'required|exists:regions,id',
        ];
    }
    public function messages()
    {
        return [
            'id.*'              =>  'Bàn không tồn tại!',
            'table_name.required'  =>  'Yêu cầu phải nhập tên bàn',
            'table_name.min'       =>  'Tên bàn phải từ 5 ký tự',
            'table_name.max'       =>  'Tên bàn tối đa được 30 ký tự',
            'table_slug.*'        =>  'Slug bàn đã tồn tại!',
            'opening_price.*'      =>  'Giá bán ít nhất là 0đ',
            'hourly_rate.*'        =>  'Tiền giờ ít nhất là 0đ',
            'status.*'      =>  'Vui lòng chọn tình trạng theo yêu cầu!',
        ];
    }
}
