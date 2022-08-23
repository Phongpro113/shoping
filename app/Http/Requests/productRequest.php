<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255|min:2',
            'price' => 'required',
            'category_id' => 'required',
            'contents' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'yêu cầu nhập tên',
            'name.unique' => 'tên không được trùng',
            'name.max' => 'tên không quá 255 ký tự',
            'name.min' => 'tên không ít hơn 2 ký tự',
            'price.required' => 'yêu cầu nhập giá',
            'category_id.required' => 'yêu cầu chọn danh mục',
            'contents.required' => 'yêu cầu nhập nội dung',
        ];
    }
}
