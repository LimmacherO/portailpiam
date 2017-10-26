<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VersionUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'version' => 'bail|required|max:255',
            'libelle' => 'bail|required|max:255',
            'application_id' => 'required',
            'referentqi_id' => 'required',
            'referencealfa' => 'max:6',
            'inc_nblivtma' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ est obligatoire',
            'referencealfa.max' => 'Le champ ne doit pas dépasser 6 caractères',
        ];
    }

}
