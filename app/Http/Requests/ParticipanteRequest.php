<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParticipanteRequest extends FormRequest
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
        foreach ($this->all() as $key => $value){
            if(!is_null($value)){
                $this->offsetSet($key, htmlentities($value));
            }
        }

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'email'     => 'required|unique:users|max:100',
                        'password' => 'same:password_confirmed|min:6',
                    ];
                }
            case 'PUT':
                {
                    return [
                        'email'     => [
                            'required',
                            'max:100',
                            'required',
                             Rule::unique('users')->ignore($this->input('id')),
                        ],
                        'password' => 'same:password_confirmed',
                    ];
                }
            default:break;
        }
    }

}
