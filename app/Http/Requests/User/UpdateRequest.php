<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = auth()->user()->id;

        return [
            'name' => 'string|max:255',
            'email' => "email:dns|unique:users,email,$userId,id",
            ];
    }
}
