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
        return [
            'role_id' => 'required|array|exists:roles,id',
            'first_name' => 'required|string|alpha',
            'last_name' => 'required|string|alpha',
            'dob' => 'required|date|before:-13 years',
        ];
    }
}
