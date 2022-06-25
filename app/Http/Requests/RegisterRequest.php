<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username'=>['required','unique:users','alpha_num','min:3','max:30'],
            'email'=>['unique:users','email'],
            'password'=>['required','min:5']
            'namalengkap'=>['required','alpha_num','min:2','max:50'],
            'role_id'=>['required']
        ];
    }
}
