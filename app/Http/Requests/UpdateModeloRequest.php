<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateModeloRequest extends FormRequest
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
            'nome' => [
                'required',
                'max:255',
                Rule::unique('modelos', 'nome')->ignore($this->route('modelo'))],
            'marca_id' => 'required|exists:marcas,id'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'O modelo informado já existe.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'marca_id.required' => 'O campo marca é obrigatório.',
            'marca_id.exists' => 'A marca informada não existe.',
        ];
    }
}
