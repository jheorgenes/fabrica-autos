<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendaRequest extends FormRequest
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
            'carro_id' => 'required|exists:carros,id',
            'opcionais' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
            'carro_id.required' => 'Selecione um carro.',
            'carro_id.exists' => 'O carro não encontrado',
        ];
    }
}
