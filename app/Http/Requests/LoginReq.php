<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LoginReq extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ];
    }

    public function message()
    {
        return [
            'email.required' => 'Email-ID required.',
            'email.email' => 'Email-ID must be a vaid mail type..',
            'password.required' => 'Password Required.',
            'password.min' => 'Password minimum length 3.'
        ];
    }
}
