<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric',
            'titulo' => 'required|string',
            'categoria_id' => 'required|numeric',
            'telefone' => 'required|string',
            'endereco' => 'required|string',
            'descricao' => 'required|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'O campo user_id é obrigatório.',
            'user_id.numeric' => 'O campo user_id deve ser um valor numérico.',
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser uma string.',
            'categoria_id.required' => 'O campo categoria_id é obrigatório.',
            'categoria_id.numeric' => 'O campo categoria_id deve ser um valor numérico.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O campo telefone deve ser uma string.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'endereco.string' => 'O campo endereço deve ser uma string.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'imagem.required' => 'O campo imagem é obrigatório.',
            'imagem.image' => 'O campo imagem deve ser uma imagem.',
            'imagem.mimes' => 'O campo imagem deve ser do tipo jpeg, png, jpg ou gif.',
            'imagem.max' => 'O tamanho máximo da imagem é 2048 KB.',
        ];
    }
}
