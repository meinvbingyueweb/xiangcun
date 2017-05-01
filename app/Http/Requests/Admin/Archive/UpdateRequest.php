<?php namespace App\Http\Requests\Admin\Archive;

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
            'title' => ['string'],
            'keywords' => ['string'],
            'description' => ['string'],
            'content' => ['string'],
        ];
    }
}
