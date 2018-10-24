<?php

namespace App\Http\Requests\Publico;

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
                        'cpf'                   => 'required|cpf|unique:participante',
                        'email'                 => 'required|email|unique:participante',
                        'password'              => 'required|confirmed',
                        'password_confirmation' => 'required',
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
            'cpf.unique'            => "Esse cpf já esta sendo utilizado em outro cadastro. Se você já fez um cadastro clique <a href='/login' target='_blank'>aqui</a> para entrar",
            'password.required'     => "Informe sua senha",
            'password.min'              => "A senha deve ter no mínimo 6 caracteres",
            'password_confirmed.min'     => "A senha deve ter no mínimo 6 caracteres",
            'password.confirmed'        => "O campo senha e confirmar senha deve ser iguais",
            'password_confirmation.required'  => "Repita a senha no campo confirmar senha",
        ];
    }  
}
