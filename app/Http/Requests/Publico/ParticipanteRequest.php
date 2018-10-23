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
           ;
                    return [];
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
            'cpf.unique'            => "Esse cpf já esta sendo utilizado em outro agendamento. Se você já fez um agendamento clique <a href='/meu-agendamento/entrar' target='_blank'>aqui</a> para alterar seu agendamento",
            'horarios_id.required'  => "Informe o horário para o agendamento",
            'password.required'     => "Informe sua senha",
            'password.min'              => "A senha deve ter no mínimo 6 caracteres",
            'password_confirmed.min'     => "A senha deve ter no mínimo 6 caracteres",
            'password.confirmed'        => "O campo senha e confirmar senha deve ser iguais",
            'password_confirmed.required'  => "Repita a senha no campo confirmar senha",
            'candidato.0.required'  => "O campo nome do aluno deve ser preenchido",
            'candidato.1.required'  => "O campo nome do aluno deve ser preenchido",
            'candidato.2.required'  => "O campo nome do aluno deve ser preenchido",
            'candidato.3.required'  => "O campo nome do aluno deve ser preenchido",
            'candidato.4.required'  => "O campo nome do aluno deve ser preenchido",
            'candidato.5.required'  => "O campo nome do aluno deve ser preenchido",
            'serie.0.required'  => "O campo série do aluno deve ser preenchida",
            'serie.1.required'  => "O campo série do aluno deve ser preenchida",
            'serie.2.required'  => "O campo série do aluno deve ser preenchida",
            'serie.3.required'  => "O campo série do aluno deve ser preenchida",
            'serie.4.required'  => "O campo série do aluno deve ser preenchida",
            'serie.5.required'  => "O campo série do aluno deve ser preenchida",
        ];
    }  
}
