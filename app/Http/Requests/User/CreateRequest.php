<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ];
    }
}
