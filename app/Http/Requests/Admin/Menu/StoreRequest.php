<?php namespace App\Http\Requests\Admin\Menu;

use App\Http\Requests\HttpRequest;

class StoreRequest extends HttpRequest
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
            'name' => ['required','string'],
            'link' => ['required','string'],
            'sort' => ['required','integer'],
            'rid' => ['required'],
            'pid' => ['required'],
            'level' => ['required','integer'],
        ];
    }
}
