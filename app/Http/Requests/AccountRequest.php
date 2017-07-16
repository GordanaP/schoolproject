<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
                    'first_name' => 'required|string|alpha',
                    'last_name' => 'required|string|alpha',
                    'role_id' => 'required|exists:roles,id',
                    'password' => 'required|string|min:6'
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'role_id' => 'required|exists:roles,id',
                    'password' => 'nullable|string|min:6'
                ];
                break;
        }


    }
}
