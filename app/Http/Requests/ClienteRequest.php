<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'nome'              => 'required',
            'email'             => 'required | unique:clientes',
            'telefone'          => 'required',
            'data_nascimento'   => 'required',
            'endereco'          => 'required',
            'bairro'            => 'required',
            'cep'               => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'email.required'  => 'O campo e-mail é obrigatório.',
            'email.unique'  => 'Esse e-mail já está cadastrado.',
            'telefone.required'  => 'O campo telefone é obrigatório.',
            'data_nascimento.required'  => 'O campo data de nascimento é obrigatório.',
            'endereco.required'  => 'O campo endereço é obrigatório.',
            'bairro.required'  => 'O campo bairro é obrigatório.',
            'cep.required'  => 'O campo cep é obrigatório.'
        ];
    }
}
