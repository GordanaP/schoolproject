<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                    'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:50|unique:roles,name',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:50|unique:roles,name,'.$this->role->id,
                ];
                break;
        }

    }
}
