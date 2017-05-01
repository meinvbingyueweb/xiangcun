<?php namespace App\Http\Requests;

use App\Exceptions\JsonException;
use Illuminate\Foundation\Http\FormRequest;

class HttpRequest extends FormRequest
{
    public function response(array $errors)
    {
        $error = 'parameter invalid';
        if(count($errors)>0){
            foreach ($errors as $e){
                $error = $e[0];
                break;
            }
        }

        if ($this->expectsJson()) {
            throw new JsonException(10000,'',$error);
        }
    }
}