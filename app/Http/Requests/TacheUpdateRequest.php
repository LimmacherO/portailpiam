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
            'debut' => 'date_format:"d/m/Y"|nullable',
            'fin' => 'date_format:"d/m/Y"|nullable|after_or_equal:debut',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ est obligatoire',
            'date_format' => 'La date doit être au format jj/mm/aaaa',
            'after_or_equal' => 'La date de fin doit être égale ou supérieure à la date de début',
        ];
    }
}
