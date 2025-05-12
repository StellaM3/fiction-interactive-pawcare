<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'choice_id' => 'required|exists:choices,id',
            'user_id' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'choice_id.required' => 'Un choix est requis',
            'choice_id.exists' => 'Ce choix n\'existe pas',
            'user_id.required' => 'L\'identifiant utilisateur est requis',
            'user_id.integer' => 'L\'identifiant utilisateur doit être un nombre',
            'user_id.min' => 'L\'identifiant utilisateur doit être positif'
        ];
    }
}