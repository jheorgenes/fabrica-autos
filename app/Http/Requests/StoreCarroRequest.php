<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarroRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'placa' => 'required|unique:carros,placa',
            'modelo_id' => 'required|exists:modelos,id',
            'cor' => 'required|in:Preto,Branco,Prata',
            'preco' => 'required|numeric|min:1000',
        ];
    }

    public function messages()
    {
        return [
            'placa.required' => 'O campo placa é obrigatório.',
            'placa.unique' => 'Essa placa já está cadastrada.',
            'cor.required' => 'O campo cor é obrigatório.',
            'cor.in' => 'O campo cor deve ser Preto, Branco ou Prata.',
            'preco.required' => 'O campo preco é obrigatório.',
            'preco.numeric' => 'O campo preco deve ser numérico.',
            'preco.min' => 'O campo preco deve ser maior ou igual a 1000.',
            'modelo_id.required' => 'O campo modelo_id é obrigatório.',
            'modelo_id.exists' => 'O modelo selecionado não existe.',
        ];
    }
}
