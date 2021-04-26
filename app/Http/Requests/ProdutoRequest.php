<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome' => 'required',
            'preco' => 'required | numeric',
            'foto' => 'required | mimes:jpeg,png | max:2000'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'preco.required'  => 'O preço é obrigatório.',
            'preco.numeric'  => 'O preço deve ser um valor numérico.',
            'foto.required'  => 'A foto é obrigatória.',
            'foto.mimes'  => 'A foto deve ser um arquivo do tipo: jpeg, png.',
            'foto.max'  => 'A foto não pode ser maior que 2000 kilobytes.'
        ];
    }
}
