<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RecuperacaContaRequest extends FormRequest
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

        switch($this->method())
        {
            case 'GET':
            break;
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'email' => [
                            'required',
                            'email',
                            'exists:participante,email'

                        ]
                    ];
                }
            case 'PUT':
                {
                    return [];
                }
            default:break;
        }
    }

     public function messages()
    {
        return [
            'email.exists'            => "Esse email não existe em nosa base de dados",
           
        ];
    }  



}
