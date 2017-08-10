<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
                    'name' => 'required|string|alpha_num_spaces|max:50|unique:subjects,name'
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string|alpha_num_spaces|max:50|unique:subjects,name,'.$this->subject->id
                ];
                break;

        }
    }
}
