<?php namespace App\Http\Requests\Admin\Arctype;

use App\Http\Requests\HttpRequest;

class StroeRequest extends HttpRequest
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
            'typename' => ['required','string'],
            'typedir' => ['required','string'],
            'enable' => ['required','in:0,1'],
            'reid' => ['required','integer'],
            'topid' => ['required','integer'],
            'sort' => ['required','integer'],
        ];
    }
}
