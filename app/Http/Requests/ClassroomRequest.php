<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'label' => 'required|string|alpha_dash|max:10|unique:classrooms,label'
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'label' => 'required|string|alpha_dash|max:10|unique:classrooms,label,'.$this->classroom->id,
                ];
                break;
        }
    }
}