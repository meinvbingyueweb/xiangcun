<?php namespace App\Http\Requests\Admin\Menu;

use App\Http\Requests\HttpRequest;

class UpdateRequest extends HttpRequest
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
            '_id' => ['required','string'],
            'name' => ['string'],
            'link' => ['string'],
            'sort' => ['integer'],
            'icon' => [],
        ];
    }
}
