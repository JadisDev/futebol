<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
{
    use FailedValidation;
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = 'required|min:3';
        return [
            'login' => $rule,
            'password' => $rule,
            'name' => $rule,
            'admin' => 'required|boolean'
        ];
    }
}
