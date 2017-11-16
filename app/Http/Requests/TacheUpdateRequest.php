<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TacheUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'libelle' => 'bail|required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ est obligatoire',
        ];
    }
}
