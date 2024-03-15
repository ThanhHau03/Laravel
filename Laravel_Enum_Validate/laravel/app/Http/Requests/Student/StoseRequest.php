<?php

namespace App\Http\Requests\Student;

use App\Enums\StudentStatusEnum;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today', // lớn hơn thời gian hiện tại
            ],
            'status' => [
                'required',
                Rule::in(StudentStatusEnum::getArrayView()),
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ];
    }
}
