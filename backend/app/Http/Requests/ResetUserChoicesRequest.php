<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetUserChoicesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'L\'identifiant utilisateur est requis',
            'user_id.integer' => 'L\'identifiant utilisateur doit être un nombre',
            'user_id.min' => 'L\'identifiant utilisateur doit être positif'
        ];
    }
}