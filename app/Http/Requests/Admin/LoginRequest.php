<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\HttpRequest;

class LoginRequest extends HttpRequest
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
            'username' => ['required','string'],
            'password' => ['required','string'],
        ];
    }
}
