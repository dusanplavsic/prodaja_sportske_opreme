<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProizvodiStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'naziv' => ['required', 'string'],
            'opis' => ['required', 'string'],
            'cena' => ['required', 'integer'],
            'kolicina_na_stanju' => ['required', 'integer'],
            'kategorija_id' => ['required', 'integer', 'exists:Kategorije,id'],
        ];
    }
}
