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
            'referencealfa' => 'required|max:6',
            'date_mep' => 'required',
            'inc_nblivtma' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ est obligatoire',
        ];
    }

}
