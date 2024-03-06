<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoseRequest extends FormRequest
{
    // làm tính năng đăng nhập
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'unique:App\Models\Course,name',
            ],
//            'name2' => [
//                'required',
//            ],
        ];
    }

    public function messages() : array
    {
        return [
            'required' => ':attribute Bắt buộc phải điền',
            'unique' => ':attribute đã được dùng',
        ];
    }

    public function attributes() : array
    {
        return [
            'name' =>  'Name',
//            'name2' =>  'Name 2 nè',
        ];
    }
}
